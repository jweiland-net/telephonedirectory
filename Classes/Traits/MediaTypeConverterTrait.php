<?php

declare(strict_types=1);

/*
 * This file is part of the package jweiland/telephonedirectory.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace JWeiland\Telephonedirectory\Traits;

use JWeiland\Telephonedirectory\Property\TypeConverter\UploadMultipleFilesConverter;
use TYPO3\CMS\Extbase\Mvc\Controller\MvcPropertyMappingConfiguration;
use TYPO3\CMS\Extbase\Property\TypeConverterInterface;

trait MediaTypeConverterTrait
{
    /**
     * Currently only "image" are allowed properties.
     *
     * @param string $property
     * @param MvcPropertyMappingConfiguration $propertyMappingConfigurationForEmployee
     * @param mixed $converterOptionValue
     * @param array $settings
     */
    protected function assignMediaTypeConverter(
        string $property,
        MvcPropertyMappingConfiguration $propertyMappingConfigurationForEmployee,
        mixed $converterOptionValue,
        array $settings
    ): void {
        if ($property === 'image') {
            $className = UploadMultipleFilesConverter::class;
            $converterOptionName = 'IMAGES';
        } else {
            return;
        }

        /** @var TypeConverterInterface $typeConverter */
        $typeConverter = GeneralUtility::makeInstance($className);
        $propertyMappingConfigurationForMediaFiles = $propertyMappingConfigurationForEmployee
            ->forProperty($property)
            ->setTypeConverter($typeConverter);

        $propertyMappingConfigurationForMediaFiles->setTypeConverterOption(
            $className,
            'settings',
            $settings
        );

        if (!empty($converterOptionValue)) {
            // Do not use setTypeConverterOptions() as this will remove all existing options
            $propertyMappingConfigurationForMediaFiles->setTypeConverterOption(
                $className,
                $converterOptionName,
                $converterOptionValue
            );
        }
    }
}
