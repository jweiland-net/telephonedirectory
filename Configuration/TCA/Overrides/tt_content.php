<?php
if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'Telephonedirectory',
    'Telephone',
    'Telephone: Main'
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'Telephonedirectory',
    'Interpreter',
    'Telephone: Interpreter'
);
