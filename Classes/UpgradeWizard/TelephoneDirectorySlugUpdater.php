<?php

declare(strict_types=1);

/*
 * This file is part of the package jweiland/telephonedirectory.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace JWeiland\Telephonedirectory\UpgradeWizard;

use Doctrine\DBAL\Exception;
use JWeiland\Telephonedirectory\Helper\PathSegmentHelper;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Database\Query\Restriction\DeletedRestriction;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Install\Attribute\UpgradeWizard;
use TYPO3\CMS\Install\Updates\DatabaseUpdatedPrerequisite;
use TYPO3\CMS\Install\Updates\UpgradeWizardInterface;

/**
 * Updater to fill empty slug columns of employee records
 */
#[UpgradeWizard('telephonedirectoryUpdateSlug')]
class TelephoneDirectorySlugUpdater implements UpgradeWizardInterface
{
    private const TABLE = 'tx_telephonedirectory_domain_model_employee';

    private const FIELD = 'path_segment';

    public function __construct(private readonly PathSegmentHelper $pathSegmentHelper) {}

    /**
     * Return the identifier for this wizard
     * This should be the same string as used in the ext_localconf class registration
     */
    public function getIdentifier(): string
    {
        return 'telephonedirectoryUpdateSlug';
    }

    public function getTitle(): string
    {
        return '[telephonedirectory] Update Slug of employee records';
    }

    public function getDescription(): string
    {
        return 'Update empty slug column "path_segment" of employee records with an URI compatible version of the employee name';
    }

    public function updateNecessary(): bool
    {
        $queryBuilder = $this->getConnectionPool()->getQueryBuilderForTable(self::TABLE);
        $queryBuilder->getRestrictions()->removeAll();
        $queryBuilder->getRestrictions()->add(GeneralUtility::makeInstance(DeletedRestriction::class));

        $amountOfRecordsWithEmptySlug = $queryBuilder
            ->count('*')
            ->from(self::TABLE)
            ->where(
                $queryBuilder->expr()->or(
                    $queryBuilder->expr()->eq(
                        self::FIELD,
                        $queryBuilder->createNamedParameter(''),
                    ),
                    $queryBuilder->expr()->isNull(
                        self::FIELD,
                    ),
                ),
            )
            ->executeQuery()
            ->fetchOne();

        return (bool)$amountOfRecordsWithEmptySlug;
    }

    /**
     * Performs the accordant updates.
     *
     * @return bool Whether everything went smoothly or not
     * @throws Exception
     */
    public function executeUpdate(): bool
    {
        $queryBuilder = $this->getConnectionPool()->getQueryBuilderForTable(self::TABLE);
        $queryBuilder->getRestrictions()->removeAll();
        $queryBuilder->getRestrictions()->add(GeneralUtility::makeInstance(DeletedRestriction::class));

        $statement = $queryBuilder
            ->select('uid', 'pid', 'first_name', 'last_name')
            ->from(self::TABLE)
            ->where(
                $queryBuilder->expr()->or(
                    $queryBuilder->expr()->eq(
                        self::FIELD,
                        $queryBuilder->createNamedParameter(''),
                    ),
                    $queryBuilder->expr()->isNull(
                        self::FIELD,
                    ),
                ),
            )
            ->executeQuery();

        $connection = $this->getConnectionPool()->getConnectionForTable(self::TABLE);
        while ($recordToUpdate = $statement->fetchAssociative()) {
            if ((string)$recordToUpdate['first_name'] !== '' && (string)$recordToUpdate['last_name'] !== '') {
                $connection->update(
                    self::TABLE,
                    [
                        self::FIELD => $this->pathSegmentHelper->generatePathSegment(
                            $recordToUpdate,
                            (int)$recordToUpdate['pid'],
                        ),
                    ],
                    [
                        'uid' => (int)$recordToUpdate['uid'],
                    ],
                );
            }
        }

        return true;
    }

    /**
     * @return string[]
     */
    public function getPrerequisites(): array
    {
        return [
            DatabaseUpdatedPrerequisite::class,
        ];
    }

    protected function getConnectionPool(): ConnectionPool
    {
        return GeneralUtility::makeInstance(ConnectionPool::class);
    }
}
