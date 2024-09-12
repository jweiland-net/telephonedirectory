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
use Psr\Log\LoggerInterface;
use TYPO3\CMS\Core\Database\Connection;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Database\Query\QueryBuilder;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Install\Attribute\UpgradeWizard;
use TYPO3\CMS\Install\Updates\DatabaseUpdatedPrerequisite;
use TYPO3\CMS\Install\Updates\UpgradeWizardInterface;

/**
 * This updater is intended to migrate department and subject fields from a
 * single mm table to separate mm tables.
 */
#[UpgradeWizard('telephonedirectorySingleToSeparateMmTableUpdater')]
final class SingleToSeperateMmTableUpdater implements UpgradeWizardInterface
{
    public function __construct(
        private readonly LoggerInterface $logger,
    ) {}

    private const OLD_DEPARTMENT_FIELD_NAME = 'departments';
    private const OLD_SUBJECT_FIELD_NAME = 'subject_fields';
    private const TABLE_OLD_MM = 'tx_telephonedirectory_office_mm';
    private const TABLE_NEW_DEPARTMENT_MM = 'tx_telephonedirectory_domain_model_office_department_mm';
    private const TABLE_NEW_SUBJECT_FIELD_MM = 'tx_telephonedirectory_domain_model_office_subjectfield_mm';

    public function getIdentifier(): string
    {
        return 'telephonedirectorySingleToSeparateMmTableUpdater';
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
        $queryBuilder = $this->getQueryBuilderForOldTable();
        $schemaManager = $queryBuilder->getConnection()->createSchemaManager();
        if (!array_key_exists(
            'fieldname',
            $schemaManager->listTableColumns($this->getOldTableName()),
        )) {
            return false;
        }

        $recordsToUpdate = $queryBuilder
            ->count('*')
            ->from($this->getOldTableName())
            ->where(
                $this->getStatementForAffectedRecords($queryBuilder),
            )
            ->executeQuery()
            ->fetchOne();

        return (bool)$recordsToUpdate;
    }

    public function executeUpdate(): bool
    {
        $queryBuilder = $this->getQueryBuilderForOldTable();
        $statement = $queryBuilder
            ->select('*')
            ->from($this->getOldTableName())
            ->where(
                $this->getStatementForAffectedRecords($queryBuilder),
            )
            ->executeQuery();

        $connection = $this->getConnectionPool()
            ->getConnectionForTable(self::TABLE_OLD_MM);
        try {
            while ($recordToUpdate = $statement->fetchAssociative()) {
                try {
                    $connection->beginTransaction();
                    $this->migrateRecord($recordToUpdate);

                    // Double-check insertion then delete the record from old table
                    if ($this->isRecordMigrated($recordToUpdate)) {
                        $connection->delete(
                            $this->getOldTableName(),
                            [
                                'fieldname' => $recordToUpdate['fieldname'],
                                'uid_foreign' => $recordToUpdate['uid_foreign'],
                                'uid_local' => $recordToUpdate['uid_local'],
                            ],
                        );
                    }
                    $connection->commit();
                } catch (\Exception $exception) {
                    $connection->rollBack(); // Revert changes on failure
                    $this->logError($exception);
                }
            }
        } catch (\Exception $exception) {
            $this->logError($exception);
            return false;
        }

        return true;
    }

    /**
     * @param array<string, mixed> $recordToUpdate
     */
    private function isRecordMigrated(array $recordToUpdate): bool
    {
        try {
            // Determine the table based on the fieldname
            $table = $recordToUpdate['fieldname'] === self::OLD_DEPARTMENT_FIELD_NAME
                ? self::TABLE_NEW_DEPARTMENT_MM
                : self::TABLE_NEW_SUBJECT_FIELD_MM;

            // Check if the record was successfully migrated to the new table
            $queryBuilder = $this->getConnectionPool()
                ->getQueryBuilderForTable($table);
            // Query to check if the record exists
            $recordExists = $queryBuilder
                ->count('*')
                ->from($table)
                ->where(
                    $queryBuilder->expr()->eq(
                        'uid_local',
                        $queryBuilder->createNamedParameter($recordToUpdate['uid_local'], Connection::PARAM_INT),
                    ),
                    $queryBuilder->expr()->eq(
                        'uid_foreign',
                        $queryBuilder->createNamedParameter($recordToUpdate['uid_foreign'], Connection::PARAM_INT),
                    ),
                )
                ->executeQuery()
                ->fetchOne();

            return (bool)$recordExists;
        } catch (\Exception $exception) {
            $this->logError($exception);

            return false;
        }
    }

    public function getPrerequisites(): array
    {
        return [
            DatabaseUpdatedPrerequisite::class,
        ];
    }

    protected function getOldTableName(): string
    {
        return self::TABLE_OLD_MM;
    }

    protected function getStatementForAffectedRecords(QueryBuilder $queryBuilder): CompositeExpression
    {
        $departmentCondition = $queryBuilder->expr()->eq(
            'fieldname',
            $queryBuilder->createNamedParameter(self::OLD_DEPARTMENT_FIELD_NAME),
        );

        $subjectFieldCondition = $queryBuilder->expr()->eq(
            'fieldname',
            $queryBuilder->createNamedParameter(self::OLD_SUBJECT_FIELD_NAME),
        );

        return $queryBuilder->expr()->or($departmentCondition, $subjectFieldCondition);
    }

    protected function getConnectionPool(): ConnectionPool
    {
        return GeneralUtility::makeInstance(ConnectionPool::class);
    }

    protected function getQueryBuilderForOldTable(): QueryBuilder
    {
        return $this->getConnectionPool()->getQueryBuilderForTable($this->getOldTableName());
    }

    /**
     * @param array<string, mixed> $recordToUpdate
     */
    private function migrateRecord(array $recordToUpdate): void
    {
        if ($recordToUpdate['fieldname'] === self::OLD_DEPARTMENT_FIELD_NAME) {
            $this->migrateToDepartmentTable($recordToUpdate);
        } elseif ($recordToUpdate['fieldname'] === self::OLD_SUBJECT_FIELD_NAME) {
            $this->migrateToSubjectFieldTable($recordToUpdate);
        }
    }

    /**
     * @param array<string, mixed> $recordToUpdate
     */
    private function migrateToDepartmentTable(array $recordToUpdate): void
    {
        try {
            $connectionToDepartmentMmTable = $this->getConnectionPool()
                ->getConnectionForTable(self::TABLE_NEW_DEPARTMENT_MM);
            $connectionToDepartmentMmTable->insert(
                self::TABLE_NEW_DEPARTMENT_MM,
                [
                    'uid_local' => (int)$recordToUpdate['uid_local'],
                    'uid_foreign' => (int)$recordToUpdate['uid_foreign'],
                ],
            );
        } catch (\Exception $exception) {
            $this->logError($exception);
        }
    }

    /**
     * @param array<string, mixed> $recordToUpdate
     */
    private function migrateToSubjectFieldTable(array $recordToUpdate): void
    {
        try {
            $connectionToSubjectFieldMmTable = $this->getConnectionPool()
                ->getConnectionForTable(self::TABLE_NEW_SUBJECT_FIELD_MM);
            $connectionToSubjectFieldMmTable->insert(
                self::TABLE_NEW_SUBJECT_FIELD_MM,
                [
                    'uid_local' => (int)$recordToUpdate['uid_local'],
                    'uid_foreign' => (int)$recordToUpdate['uid_foreign'],
                ],
            );
        } catch (\Exception $exception) {
            $this->logError($exception);
        }
    }

    private function logError(\Exception $exception): void
    {
        $this->logger->error($exception->getMessage(), [
            'exception' => $exception,
            'stackTrace' => $exception->getTraceAsString(),
        ]);
    }
}
