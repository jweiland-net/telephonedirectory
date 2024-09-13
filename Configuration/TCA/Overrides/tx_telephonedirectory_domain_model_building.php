<?php

/*
 * This file is part of the package jweiland/telephonedirectory.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

if (!defined('TYPO3')) {
    die('Access denied.');
}

use JWeiland\Maps2\Tca\Maps2Registry;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

call_user_func(static function (): void {
    // Add tx_maps2_uid column to telephone directory table
    if (ExtensionManagementUtility::isLoaded('maps2')) {
        Maps2Registry::getInstance()->add(
            'telephonedirectory',
            'tx_telephonedirectory_domain_model_building',
            [
                'addressColumns' => ['street', 'house_number', 'zip', 'city'],
                'defaultCountry' => 'Germany',
                'synchronizeColumns' => [
                    [
                        'foreignColumnName' => 'title',
                        'poiCollectionColumnName' => 'title',
                    ],
                ],
            ],
        );
    }
});
