<?php
if (!defined('TYPO3')) {
    die('Access denied.');
}

call_user_func(static function () {
    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
        'Telephonedirectory',
        'Telephone',
        [
            \JWeiland\Telephonedirectory\Controller\EmployeeController::class => 'list, search, show, new, create, edit, update, sendEditMail'
        ], // non-cacheable actions
        [
            \JWeiland\Telephonedirectory\Controller\EmployeeController::class => 'search, edit, create, update, sendEditMail'
        ]
    );

    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
        'Telephonedirectory',
        'Interpreter',
        [
            \JWeiland\Telephonedirectory\Controller\InterpreterController::class => 'list',
            \JWeiland\Telephonedirectory\Controller\EmployeeController::class => 'list, search, show, new, create, edit, update, sendEditMail'
        ], // non-cacheable actions
        [
            \JWeiland\Telephonedirectory\Controller\InterpreterController::class => '',
            \JWeiland\Telephonedirectory\Controller\EmployeeController::class => 'search, edit, create, update, sendEditMail'
        ]
    );

    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
        'Telephonedirectory',
        'ShowRecords',
        [
            \JWeiland\Telephonedirectory\Controller\EmployeeController::class => 'showRecords'
        ]
    );

    $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['scheduler']['tasks'][JWeiland\Telephonedirectory\Task\SendMailToEmployeeTask::class] = [
        'extension' => 'telephonedirectory',
        'title' => 'Send email to every employee about their current data',
        'description' => 'Send email to every employee about their current data',
        'additionalFields' => \JWeiland\Telephonedirectory\Task\SendMailToEmployeeAdditionalFieldProvider::class
    ];
});
