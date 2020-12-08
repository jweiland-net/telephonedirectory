<?php
if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

call_user_func(static function ($extKey) {
    $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['scheduler']['tasks'][JWeiland\Telephonedirectory\Task\SendMailToEmployeeTask::class] = [
        'extension' => $extKey,
        'title' => 'Send email to every employee about their current data',
        'description' => 'Send email to every employee about their current data',
        'additionalFields' => \JWeiland\Telephonedirectory\Task\SendMailToEmployeeAdditionalFieldProvider::class
    ];

    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
        'JWeiland.' . $extKey,
        'Telephone',
        [
            'Employee' => 'list, search, show, new, create, edit, update, sendEditMail'
        ], // non-cacheable actions
        [
            'Employee' => 'search, edit, create, update, sendEditMail'
        ]
    );

    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
        'JWeiland.' . $extKey,
        'Interpreter',
        [
            'Interpreter' => 'list',
            'Employee' => 'list, search, show, new, create, edit, update, sendEditMail'
        ], // non-cacheable actions
        [
            'Interpreter' => '',
            'Employee' => 'search, edit, create, update, sendEditMail'
        ]
    );

    $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['ext/install']['update']['telephonedirectoryUpdateSlug']
        = \JWeiland\Telephonedirectory\Updater\TelephonedirectorySlugUpdater::class;
}, 'telephonedirectory');
