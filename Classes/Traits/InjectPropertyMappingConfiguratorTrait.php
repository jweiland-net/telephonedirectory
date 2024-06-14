<?php

declare(strict_types=1);

/*
 * This file is part of the package jweiland/telephonedirectory.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace JWeiland\Telephonedirectory\Traits;

use JWeiland\Telephonedirectory\Utility\PropertyMappingConfigurator;

trait InjectPropertyMappingConfiguratorTrait
{
    protected PropertyMappingConfigurator $propertyMappingConfigurator;

    public function injectPropertyMappingConfigurator(PropertyMappingConfigurator $propertyMappingConfigurator): void
    {
        $this->$propertyMappingConfigurator = $propertyMappingConfigurator;
    }
}
