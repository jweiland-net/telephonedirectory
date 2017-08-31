<?php
namespace JWeiland\Telephonedirectory\Task;

/*
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

use TYPO3\CMS\Scheduler\AdditionalFieldProviderInterface;
use TYPO3\CMS\Scheduler\Controller\SchedulerModuleController;
use TYPO3\CMS\Scheduler\Task\AbstractTask;

/**
 * Class SendMailToEmployeeAdditionalFieldProvider
 *
 * @package JWeiland\Telephonedirectory\Task
 */
class SendMailToEmployeeAdditionalFieldProvider implements AdditionalFieldProviderInterface
{
    /**
     * This fields can not be empty!
     *
     * @var array
     */
    protected $requiredFields = array(
        'name',
        'city',
        'country',
        'apiKey'
    );

    /**
     * Fields to insert from task if empty
     *
     * @var array
     */
    protected $insertFields = array(
        'name',
        'city',
        'country',
        'apiKey',
        'errorNotification',
        'emailSenderName',
        'emailSender',
        'emailReceiver',
        'recordStoragePage'
    );

    /**
     * Gets additional fields to render in the form to add/edit a task
     *
     * @param array $taskInfo Values of the fields from the add/edit task form
     * @param AbstractTask|SendMailToEmployeeTask $task The task object being edited. Null when adding a task!
     * @param SchedulerModuleController $schedulerModule Reference to the scheduler backend module
     * @return array A two dimensional array, array('Identifier' => array('fieldId' => array('code' => '', 'label' => '', 'cshKey' => '', 'cshLabel' => ''))
     */
    public function getAdditionalFields(array &$taskInfo, $task, SchedulerModuleController $schedulerModule)
    {
        if (empty($taskInfo['storagePid'])) {
            if($schedulerModule->CMD == 'edit') {
                $taskInfo['storagePid'] = $task->storagePid;
            } else {
                $taskInfo['storagePid'] = '';
            }
        }

        $fieldID = 'storagePid';
        $fieldCode = '<input type="text" name="tx_scheduler[storagePid]" id="' . $fieldID . '" value="' . $taskInfo['storagePid'] . '" size="30" />';
        $additionalFields = array();
        $additionalFields[$fieldID] = array(
            'code'     => $fieldCode,
            'label'    => 'Storage pid'
        );

        return $additionalFields;
    }

    /**
     * Validates the additional fields' values
     *
     * @param array $submittedData An array containing the data submitted by the add/edit task form
     * @param SchedulerModuleController $schedulerModule Reference to the scheduler backend module
     * @return bool TRUE if validation was ok (or selected class is not relevant), FALSE otherwise
     */
    public function validateAdditionalFields(array &$submittedData, SchedulerModuleController $schedulerModule)
    {
        $submittedData['storagePid'] = trim($submittedData['storagePid']);

        return true;
    }

    /**
     * Takes care of saving the additional fields' values in the task's object
     *
     * @param array $submittedData An array containing the data submitted by the add/edit task form
     * @param AbstractTask|SendMailToEmployeeTask $task Reference to the scheduler backend module
     * @return void
     */
    public function saveAdditionalFields(array $submittedData, AbstractTask $task)
    {
        $task->storagePid = $submittedData['storagePid'];
    }
}
