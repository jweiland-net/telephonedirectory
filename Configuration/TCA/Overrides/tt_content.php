<?php

/*
 * This file is part of the package jweiland/telephonedirectory.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Extbase\Utility\ExtensionUtility;

/*
 * This file is part of the package jweiland/telephonedirectory.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

if (!defined('TYPO3')) {
    die('Access denied.');
}

ExtensionUtility::registerPlugin(
    'Telephonedirectory',
    'Telephone',
    'LLL:EXT:telephonedirectory/Resources/Private/Language/locallang_db.xlf:plugin.telephonedirectory.employees.title',
    'ext-telephonedirectory-employees-wizard-icon',
    'Telephone Directory',
    'LLL:EXT:telephonedirectory/Resources/Private/Language/locallang_db.xlf:plugin.telephonedirectory.employees.description',
);

ExtensionUtility::registerPlugin(
    'Telephonedirectory',
    'Interpreter',
    'LLL:EXT:telephonedirectory/Resources/Private/Language/locallang_db.xlf:plugin.telephonedirectory.interpreter.title',
    'ext-telephonedirectory-interpreter-wizard-icon',
    'Telephone Directory',
    'LLL:EXT:telephonedirectory/Resources/Private/Language/locallang_db.xlf:plugin.telephonedirectory.interpreter.description',
);

ExtensionUtility::registerPlugin(
    'Telephonedirectory',
    'ShowRecords',
    'LLL:EXT:telephonedirectory/Resources/Private/Language/locallang_db.xlf:plugin.telephonedirectory.individual-employees.title',
    'ext-telephonedirectory-individual-employees-wizard-icon',
    'Telephone Directory',
    'LLL:EXT:telephonedirectory/Resources/Private/Language/locallang_db.xlf:plugin.telephonedirectory.individual-employees.description',
);

// FlexForm For ShowRecords Plugin CType
ExtensionManagementUtility::addToAllTCAtypes(
    'tt_content',
    '--div--;Configuration,pi_flexform, pages;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:pages.ALT.list_formlabel,recursive',
    'telephonedirectory_showrecords',
    'after:subheader',
);
ExtensionManagementUtility::addPiFlexFormValue(
    '*',
    'FILE:EXT:telephonedirectory/Configuration/FlexForms/ShowRecords.xml',
    'telephonedirectory_showrecords',
);

// FlexForm For MainTelephone Plugin CType
ExtensionManagementUtility::addToAllTCAtypes(
    'tt_content',
    '--div--;Configuration,pi_flexform, pages;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:pages.ALT.list_formlabel,recursive',
    'telephonedirectory_telephone',
    'after:subheader',
);
ExtensionManagementUtility::addPiFlexFormValue(
    '*',
    'FILE:EXT:telephonedirectory/Configuration/FlexForms/General.xml',
    'telephonedirectory_telephone',
);

// FlexForm For MainTelephone Plugin CType
ExtensionManagementUtility::addToAllTCAtypes(
    'tt_content',
    'pages;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:pages.ALT.list_formlabel,recursive',
    'telephonedirectory_interpreter',
    'after:subheader',
);

// FlexForm For MainTelephone Plugin CType
ExtensionManagementUtility::addToAllTCAtypes(
    'tt_content',
    'pages;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:pages.ALT.list_formlabel,recursive',
    'telephonedirectory_citymap',
    'after:subheader',
);
