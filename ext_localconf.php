<?php
if (!defined('TYPO3_MODE')) {
    die ('Access denied.');
}

$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['scheduler']['tasks'][JWeiland\Telephonedirectory\Task\SendMailToEmployeeTask::class] = array(
    'extension' => $_EXTKEY,
    'title' => 'Send email to every employee about their current data',
    'description' => 'Send email to every employee about their current data',
    'additionalFields' => \JWeiland\Telephonedirectory\Task\SendMailToEmployeeAdditionalFieldProvider::class
);

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
