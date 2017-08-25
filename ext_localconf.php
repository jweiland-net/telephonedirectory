<?php
if (!defined('TYPO3_MODE')) {
    die ('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'JWeiland.' . $_EXTKEY,
    'Telephone', array(
        'Employee' => 'list, search, show, new, create, edit, update, sendEditMail',
    ), // non-cacheable actions
    array(
        'Employee' => 'search, create, update, sendEditMail',
    )
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'JWeiland.' . $_EXTKEY,
    'Interpreter', array(
        'Interpreter' => 'list',
        'Employee' => 'list, search, show, new, create, edit, update, sendEditMail',
    ), // non-cacheable actions
    array(
        'Interpreter' => '',
        'Employee' => 'search, create, update, sendEditMail',
    )
);
