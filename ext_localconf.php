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

use JWeiland\Telephonedirectory\Controller\EmployeeController;
use JWeiland\Telephonedirectory\Controller\InterpreterController;
use JWeiland\Telephonedirectory\Task\SendMailToEmployeeAdditionalFieldProvider;
use JWeiland\Telephonedirectory\Task\SendMailToEmployeeTask;
use TYPO3\CMS\Extbase\Utility\ExtensionUtility;

call_user_func(static function () {
    ExtensionUtility::configurePlugin(
        'Telephonedirectory',
        'Telephone',
        [
            EmployeeController::class => 'list, search, show, new, create, edit, update, sendEditMail',
        ],
        // non-cacheable actions
        [
            EmployeeController::class => 'search, edit, create, update, sendEditMail',
        ],
    );

    ExtensionUtility::configurePlugin(
        'Telephonedirectory',
        'Interpreter',
        [
            InterpreterController::class => 'list',
            EmployeeController::class => 'list, search, show, new, create, edit, update, sendEditMail',
        ],
        // non-cacheable actions
        [
            InterpreterController::class => '',
            EmployeeController::class => 'search, edit, create, update, sendEditMail',
        ],
    );

    ExtensionUtility::configurePlugin(
        'Telephonedirectory',
        'ShowRecords',
        [
            EmployeeController::class => 'showRecords',
        ],
    );

    $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['scheduler']['tasks'][SendMailToEmployeeTask::class] = [
        'extension' => 'telephonedirectory',
        'title' => 'Send email to every employee about their current data',
        'description' => 'Send email to every employee about their current data',
        'additionalFields' => SendMailToEmployeeAdditionalFieldProvider::class,
    ];
});
