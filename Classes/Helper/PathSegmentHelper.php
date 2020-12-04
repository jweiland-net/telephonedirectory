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
use TYPO3\CMS\Extbase\Object\ObjectManager;
use TYPO3\CMS\Extbase\Persistence\PersistenceManagerInterface;

/*
 * Helper class to generate a path segment (slug) for a employee record.
 * Used while executing the UpgradeWizard and saving records in frontend.
 */
class PathSegmentHelper
{
    /**
     * @var SlugHelper
     */
    protected $slugHelper;

    public function __construct(SlugHelper $slugHelper = null)
    {
        if ($slugHelper === null) {
            // Add uid to slug, to prevent duplicates
            $config = $GLOBALS['TCA']['tx_telephonedirectory_domain_model_employee']['columns']['path_segment']['config'];
            $config['generatorOptions']['fields'] = ['first_name', 'last_name', 'uid'];

            $slugHelper = GeneralUtility::makeInstance(
                SlugHelper::class,
                'tx_telephonedirectory_domain_model_company',
                'path_segment',
                $config
            );
        }
        $this->slugHelper = $slugHelper;
    }

    public function generatePathSegment(
        array $baseRecord,
        int $pid
    ): string {
        return $this->slugHelper->generate(
            $baseRecord,
            $pid
        );
    }

    public function updatePathSegmentForEmployee(Employee $employee): void
    {
        // First of all, we have to check, if an UID is available
        if (!$employee->getUid()) {
            $objectManager = GeneralUtility::makeInstance(ObjectManager::class);
            $persistenceManager = $objectManager->get(PersistenceManagerInterface::class);
            $persistenceManager->persistAll();
        }

        $employee->setPathSegment(
            $this->generatePathSegment(
                $employee->getBaseRecordForPathSegment(),
                $employee->getPid()
            )
        );
    }
}
