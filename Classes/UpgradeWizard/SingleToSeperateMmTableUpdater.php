<?php

declare(strict_types=1);

/*
 * This file is part of the package jweiland/telephonedirectory.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace JWeiland\Telephonedirectory\UpgradeWizard;

use Doctrine\DBAL\Query\Expression\CompositeExpression;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Database\Query\QueryBuilder;
use TYPO3\CMS\Core\Database\Query\Restriction\DeletedRestriction;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Install\Attribute\UpgradeWizard;
use TYPO3\CMS\Install\Updates\DatabaseUpdatedPrerequisite;
use TYPO3\CMS\Install\Updates\UpgradeWizardInterface;

/**
 * This updater is intented for the migration of mm table which store department and subjectfields
 * to seperate mm tables.
 */
#[UpgradeWizard('telephonedirectorySingleToSeperateMmTableUpdater')]
final class SingleToSeperateMmTableUpdater implements UpgradeWizardInterface
{
    private const TABLE_OLD_MM = 'tx_telephonedirectory_office_mm';
    private const TABLE_NEW_DEPARTMENT_MM = 'tx_telephonedirectory_domain_model_office_department_mm';
    private const TABLE_NEW_SUBJECT_FIELD_MM = 'tx_telephonedirectory_domain_model_office_subjectfield_mm';

    public function getIdentifier(): string
    {
        return 'telephonedirectorySingleToSeperateMmTableUpdater';
    }

    public function getTitle(): string
    {
        return '[telephonedirectory] Office mm table migration';
    }

    public function getDescription(): string
    {
        return 'This updater is intented for the migration of mm table which store department and subjectfields';
    }

    public function updateNecessary(): bool
    {
        return true;
        $queryBuilder = $this->getConnectionPool()->getQueryBuilderForTable($this->getTableName());

        $schemaManager = $queryBuilder->getConnection()->createSchemaManager();

        if (!array_key_exists($this->getOldFieldName(), $schemaManager->listTableColumns($this->getTableName()))) {
            return false;
        }

        $queryBuilder->getRestrictions()->removeAll();
        $queryBuilder->getRestrictions()->add(GeneralUtility::makeInstance(DeletedRestriction::class));

        $recordsToUpdate = $queryBuilder
            ->count('*')
            ->from($this->getTableName())
            ->where(
                $this->getStatementForAffectedRecords($queryBuilder),
            )
            ->executeQuery()
            ->fetchOne();

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
                $this->getStatementForAffectedRecords($queryBuilder),
            )
            ->executeQuery();

        $connection = $this->getConnectionPool()->getConnectionForTable($this->getTableName());
        $connectionMM = $this->getConnectionPool()->getConnectionForTable($this->getMmTableName());
        while ($recordToUpdate = $statement->fetchAssociative()) {
            $uid = (int)$recordToUpdate['uid'];
            $connection->beginTransaction();
            $connectionMM->insert(
                $this->getMmTableName(),
                [
                    'uid_local' => $uid,
                    'uid_foreign' => (int)$recordToUpdate[$this->getOldFieldName()],
                    'fieldname' => $this->getNewFieldName(),
                    'tablenames' => $this->getTableName(),
                ],
            );

            $connection->update(
                $this->getTableName(),
                [$this->getNewFieldName() => 1],
                ['uid' => $uid],
            );
            $connection->commit();
        }

        return true;
    }

    public function getPrerequisites(): array
    {
        return [
            DatabaseUpdatedPrerequisite::class,
        ];
    }

    protected function getStatementForAffectedRecords(QueryBuilder $queryBuilder): CompositeExpression
    {
        return $queryBuilder->expr()->and(
            $queryBuilder->expr()->neq($this->getOldFieldName(), 0),
            $queryBuilder->expr()->eq($this->getNewFieldName(), 0),
        );
    }

    protected function getConnectionPool(): ConnectionPool
    {
        return GeneralUtility::makeInstance(ConnectionPool::class);
    }
}
