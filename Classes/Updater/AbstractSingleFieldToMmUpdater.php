<?php

declare(strict_types=1);

/*
 * This file is part of the package jweiland/telephonedirectory.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace JWeiland\Telephonedirectory\Updater;

use Doctrine\DBAL\Query\Expression\CompositeExpression;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Database\Query\QueryBuilder;
use TYPO3\CMS\Core\Database\Query\Restriction\DeletedRestriction;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Install\Updates\DatabaseUpdatedPrerequisite;
use TYPO3\CMS\Install\Updates\UpgradeWizardInterface;

/**
 * Base Class to build updater for 1:1 to m:m migrations
 */
abstract class AbstractSingleFieldToMmUpdater implements UpgradeWizardInterface
{
    abstract protected function getTableName(): string;
    abstract protected function getMmTableName(): string;

    abstract protected function getOldFieldName(): string;
    abstract protected function getNewFieldName(): string;

    public function updateNecessary(): bool
    {
        $queryBuilder = $this->getConnectionPool()->getQueryBuilderForTable($this->getTableName());

        $schemaManager = $queryBuilder->getConnection()->getSchemaManager();
        if ($schemaManager === null) {
            return false;
        }

        if (!array_key_exists($this->getOldFieldName(), $schemaManager->listTableColumns($this->getTableName()))) {
            return false;
        }

        $queryBuilder->getRestrictions()->removeAll();
        $queryBuilder->getRestrictions()->add(GeneralUtility::makeInstance(DeletedRestriction::class));

        $recordsToUpdate = $queryBuilder
            ->count('*')
            ->from($this->getTableName())
            ->where(
                $this->getStatementForAffectedRecords($queryBuilder)
            )
            ->execute()
            ->fetchColumn();

        return (bool)$recordsToUpdate;
    }

    public function executeUpdate(): bool
    {
        $queryBuilder = $this->getConnectionPool()->getQueryBuilderForTable($this->getTableName());
        $queryBuilder->getRestrictions()->removeAll();
        $queryBuilder->getRestrictions()->add(GeneralUtility::makeInstance(DeletedRestriction::class));

        $statement = $queryBuilder
            ->select('uid', $this->getOldFieldName())
            ->from($this->getTableName())
            ->where(
                $this->getStatementForAffectedRecords($queryBuilder)
            )
            ->execute();

        $connection = $this->getConnectionPool()->getConnectionForTable($this->getTableName());
        $connectionMM = $this->getConnectionPool()->getConnectionForTable($this->getMmTableName());
        while ($recordToUpdate = $statement->fetch()) {
            $uid = (int)$recordToUpdate['uid'];
            $connection->beginTransaction();
            $connectionMM->insert(
                $this->getMmTableName(),
                [
                    'uid_local' => $uid,
                    'uid_foreign' => (int)$recordToUpdate[$this->getOldFieldName()],
                    'fieldname' => $this->getNewFieldName(),
                    'tablenames' => $this->getTableName()
                ]
            );

            $connection->update(
                $this->getTableName(),
                [$this->getNewFieldName() => 1],
                ['uid' => $uid]
            );
            $connection->commit();
        }

        return true;
    }

    public function getPrerequisites(): array
    {
        return [
            DatabaseUpdatedPrerequisite::class
        ];
    }

    protected function getStatementForAffectedRecords(QueryBuilder $queryBuilder): CompositeExpression
    {
        return $queryBuilder->expr()->andX(
            $queryBuilder->expr()->neq($this->getOldFieldName(), 0),
            $queryBuilder->expr()->eq($this->getNewFieldName(), 0)
        );
    }

    protected function getConnectionPool(): ConnectionPool
    {
        return GeneralUtility::makeInstance(ConnectionPool::class);
    }
}
