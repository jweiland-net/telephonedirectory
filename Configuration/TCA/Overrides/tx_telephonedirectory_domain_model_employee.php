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

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

$GLOBALS['TCA']['tx_telephonedirectory_domain_model_employee']['columns']['additional_function'] = [
    'label' => 'LLL:EXT:telephonedirectory/Resources/Private/Language/locallang_db.xlf:' .
        'tx_telephonedirectory_domain_model_employee.additional_function',
    'exclude' => 1,
    'config' => [
        'type' => 'category',
    ],
];

ExtensionManagementUtility::addToAllTCAtypes(
    'tx_telephonedirectory_domain_model_employee',
    'additional_function',
);
