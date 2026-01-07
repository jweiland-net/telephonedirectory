<?php

declare(strict_types=1);

/*
 * This file is part of the package jweiland/telephonedirectory.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace JWeiland\Telephonedirectory\Update;

use TYPO3\CMS\Install\Attribute\UpgradeWizard;
use TYPO3\CMS\Install\Updates\AbstractListTypeToCTypeUpdate;

/**
 * With TYPO3 13 all plugins have to be declared as content elements (CType) insteadof "list_type"
 */
#[UpgradeWizard('telephonedirectory_listTypeToCTypeUpdate')]
class MigratePluginToContentElementUpdate extends AbstractListTypeToCTypeUpdate
{
    protected function getListTypeToCTypeMapping(): array
    {
        return [
            'telephonedirectory_telephone' => 'telephonedirectory_telephone',
            'telephonedirectory_interpreter' => 'telephonedirectory_interpreter',
            'telephonedirectory_showrecords' => 'telephonedirectory_showrecords',
            'telephonedirectory_citymap' => 'telephonedirectory_citymap',
        ];
    }

    public function getTitle(): string
    {
        return '[telephonedirectory] Migrate plugins to Content Elements';
    }

    public function getDescription(): string
    {
        return 'The modern way to register plugins for TYPO3 is to register them as content element types. ' .
            'Running this wizard will migrate all maps2 plugins to content element (CType)';
    }
}
