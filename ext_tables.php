<?php
if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'JWeiland.' . $_EXTKEY,
    'Telephone',
    'Telephone: Main'
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'JWeiland.' . $_EXTKEY,
    'Interpreter',
    'Telephone: Interpreter'
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile(
    $_EXTKEY,
    'Configuration/TypoScript',
    'Telephone Directory'
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr(
    'tx_telephonedirectory_domain_model_employee',
    'EXT:telephonedirectory/Resources/Private/Language/locallang_csh_tx_telephonedirectory_domain_model_employee.xlf'
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_telephonedirectory_domain_model_employee');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr(
    'tx_telephonedirectory_domain_model_office',
    'EXT:telephonedirectory/Resources/Private/Language/locallang_csh_tx_telephonedirectory_domain_model_office.xlf'
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_telephonedirectory_domain_model_office');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr(
    'tx_telephonedirectory_domain_model_building',
    'EXT:telephonedirectory/Resources/Private/Language/locallang_csh_tx_telephonedirectory_domain_model_building.xlf'
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_telephonedirectory_domain_model_building');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr(
    'tx_telephonedirectory_domain_model_department',
    'EXT:telephonedirectory/Resources/Private/Language/locallang_csh_tx_telephonedirectory_domain_model_department.xlf'
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_telephonedirectory_domain_model_department');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr(
    'tx_telephonedirectory_domain_model_languageskill',
    'EXT:telephonedirectory/Resources/Private/Language/locallang_csh_tx_telephonedirectory_domain_model_languageskill.xlf'
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_telephonedirectory_domain_model_languageskill');
