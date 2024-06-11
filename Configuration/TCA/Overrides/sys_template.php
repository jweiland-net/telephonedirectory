<?php
if (!defined('TYPO3')) {
    die('Access denied.');
}

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile(
    'telephonedirectory',
    'Configuration/TypoScript',
    'Telephone Directory'
);
