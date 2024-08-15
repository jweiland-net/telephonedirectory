<?php

declare(strict_types=1);

/*
 * This file is part of the package jweiland/telephonedirectory.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace JWeiland\Telephonedirectory\UpgradeWizard;

use TYPO3\CMS\Install\Attribute\UpgradeWizard;

/**
 * Migrate department field to departments field in office table
 */
#[UpgradeWizard('telephonedirectoryUpdateDepartmentToDepartments')]
class DepartmentToDepartmentsUpdater extends AbstractSingleFieldToMmUpdater
{
    public function getIdentifier(): string
    {
        return 'telephonedirectoryUpdateDepartmentToDepartments';
    }

    public function getTitle(): string
    {
        return '[telephonedirectory] Update department to departments field';
    }

    public function getDescription(): string
    {
        return 'Migrate existing departments from the single department field to the departments field which allows usage of multiple departments';
    }

    protected function getTableName(): string
    {
        return 'tx_telephonedirectory_domain_model_office';
    }

    protected function getMmTableName(): string
    {
        return 'tx_telephonedirectory_office_mm';
    }

    protected function getOldFieldName(): string
    {
        return 'department';
    }

    protected function getNewFieldName(): string
    {
        return 'departments';
    }
}
