<?php
if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::makeCategorizable(
    'telephonedirectory',
    'tx_telephonedirectory_domain_model_employee',
    'additional_function',
    [
        'label' => 'LLL:EXT:telephonedirectory/Resources/Private/Language/locallang_db.xlf:tx_telephonedirectory_domain_model_employee.additional_function',
        'exclude' => 1
    ]
);
