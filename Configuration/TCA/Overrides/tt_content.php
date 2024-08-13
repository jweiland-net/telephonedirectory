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

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'Telephonedirectory',
    'Telephone',
    'Telephone: Main',
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'Telephonedirectory',
    'Interpreter',
    'Telephone: Interpreter',
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'Telephonedirectory',
    'ShowRecords',
    'Telephone: Show Records',
);

$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist']['telephonedirectory_showrecords'] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue(
    'telephonedirectory_showrecords',
    'FILE:EXT:telephonedirectory/Configuration/FlexForms/ShowRecords.xml',
);

$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist']['telephonedirectory_telephone'] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue(
    'telephonedirectory_telephone',
    'FILE:EXT:telephonedirectory/Configuration/FlexForms/General.xml',
);
