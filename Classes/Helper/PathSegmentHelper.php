<?php

declare(strict_types=1);

/*
 * This file is part of the package jweiland/telephonedirectory.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace JWeiland\Telephonedirectory\Helper;

use JWeiland\Telephonedirectory\Domain\Model\Employee;
use TYPO3\CMS\Core\DataHandling\SlugHelper;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Persistence\PersistenceManagerInterface;

/*
 * Helper class to generate a path segment (slug) for a employee record.
 * Used while executing the UpgradeWizard and saving records in frontend.
 */
class PathSegmentHelper
{
    private const TABLE = 'tx_telephonedirectory_domain_model_employee';

    private const COLUMN = 'path_segment';

    public function __construct(protected PersistenceManagerInterface $persistenceManager) {}

    /**
     * @param array<string, mixed> $baseRecord
     */
    public function generatePathSegment(array $baseRecord, int $pid): string
    {
        return $this->getSlugHelper()->generate($baseRecord, $pid);
    }

    public function updatePathSegmentForEmployee(Employee $employee): void
    {
        // First of all, we have to check, if an UID is available
        if (!$employee->getUid()) {
            $this->persistenceManager->persistAll();
        }

        $employee->setPathSegment(
            $this->generatePathSegment(
                $employee->getBaseRecordForPathSegment(),
                $employee->getPid(),
            ),
        );
    }

    protected function getSlugHelper(): SlugHelper
    {
        // Add uid to slug, to prevent duplicates
        $config = $GLOBALS['TCA'][self::TABLE]['columns'][self::COLUMN]['config'];
        $config['generatorOptions']['fields'] = ['first_name', 'last_name', 'uid'];

        return GeneralUtility::makeInstance(
            SlugHelper::class,
            self::TABLE,
            self::COLUMN,
            $config,
        );
    }
}
