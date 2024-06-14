<?php

declare(strict_types=1);

/*
 * This file is part of the package jweiland/telephonedirectory.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace JWeiland\Telephonedirectory\Utility;

use TYPO3\CMS\Extbase\Mvc\Controller\MvcPropertyMappingConfiguration;

class PropertyMappingConfigurator
{
    public function configureEmployeeMapping(MvcPropertyMappingConfiguration $configuration): void
    {
        $configuration->allowProperties('languageSkill');
        $configuration->forProperty('languageSkill.*')
            ->allowProperties('language', 'writing', 'speaking')
            ->allowCreationForSubProperty('languageSkill.*')
            ->allowModificationForSubProperty('languageSkill.*');
    }
}
