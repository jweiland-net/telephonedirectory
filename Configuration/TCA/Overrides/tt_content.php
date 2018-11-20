<?php
if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'JWeiland.telephonedirectory',
    'Telephone',
    'Telephone: Main'
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'JWeiland.telephonedirectory',
    'Interpreter',
    'Telephone: Interpreter'
);
