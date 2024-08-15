<?php

declare(strict_types=1);

/*
 * This file is part of the package jweiland/telephonedirectory.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace JWeiland\Telephonedirectory\Task;

use TYPO3\CMS\Scheduler\AbstractAdditionalFieldProvider;
use TYPO3\CMS\Scheduler\Controller\SchedulerModuleController;
use TYPO3\CMS\Scheduler\Task\AbstractTask;

/**
 * Provider to add some further input fields to scheduler task
 */
class SendMailToEmployeeAdditionalFieldProvider extends AbstractAdditionalFieldProvider
{
    /**
     * Gets additional fields to render in the form to add/edit a task
     *
     * @param array<string, mixed> $taskInfo Values of the fields from the add/edit task form
     * @param AbstractTask|SendMailToEmployeeTask|null $task The task object being edited. Null when adding a task!
     * @param SchedulerModuleController $schedulerModule Reference to the scheduler backend module
     * @return array<string, mixed> A two-dimensional array
     */
    public function getAdditionalFields(array &$taskInfo, $task, SchedulerModuleController $schedulerModule): array
    {
        $additionalFields = [];

        // Ensure $task is of the expected type
        if ($task instanceof SendMailToEmployeeTask) {
            if (empty($taskInfo['storagePid'])) {
                if ((string)$schedulerModule->getCurrentAction() === 'edit') {
                    $taskInfo['storagePid'] = $task->storagePid;
                } else {
                    $taskInfo['storagePid'] = '';
                }
            }

            if (empty($taskInfo['detailViewPid'])) {
                if ((string)$schedulerModule->getCurrentAction() === 'edit') {
                    $taskInfo['detailViewPid'] = $task->detailViewPid;
                } else {
                    $taskInfo['detailViewPid'] = '';
                }
            }

            $fieldID = 'storagePid';
            $fieldCode = '<input type="text" name="tx_scheduler[storagePid]" id="' . $fieldID . '" value="' . $taskInfo['storagePid'] . '" size="30" />';
            $additionalFields[$fieldID] = [
                'code'     => $fieldCode,
                'label'    => 'Storage pid',
            ];

            $fieldID = 'detailViewPid';
            $fieldCode = '<input type="text" name="tx_scheduler[detailViewPid]" id="' . $fieldID . '" value="' . $taskInfo['detailViewPid'] . '" size="30" />';
            $additionalFields[$fieldID] = [
                'code'     => $fieldCode,
                'label'    => 'Detail View Pid',
            ];
        }

        return $additionalFields;
    }

    /**
     * Validates the additional fields' values
     *
     * @param array $submittedData An array containing the data submitted by the add/edit task form
     * @param SchedulerModuleController $schedulerModule Reference to the scheduler backend module
     * @return bool true if validation was ok (or selected class is not relevant), false otherwise
     */
    public function validateAdditionalFields(array &$submittedData, SchedulerModuleController $schedulerModule): bool
    {
        $submittedData['storagePid'] = \trim($submittedData['storagePid']);
        $submittedData['detailViewPid'] = \trim($submittedData['detailViewPid']);

        return true;
    }

    /**
     * Takes care of saving the additional fields' values in the task's object
     *
     * @param array $submittedData An array containing the data submitted by the add/edit task form
     * @param AbstractTask|SendMailToEmployeeTask $task Reference to the scheduler backend module
     */
    public function saveAdditionalFields(array $submittedData, AbstractTask $task)
    {
        // Ensure the task is of the expected type
        if ($task instanceof SendMailToEmployeeTask) {
            $task->storagePid = (int)($submittedData['storagePid'] ?? 0);
            $task->detailViewPid = (int)($submittedData['detailViewPid'] ?? 0);

        } else {
            // Handle cases where $task is not of the expected type
            throw new \InvalidArgumentException('The task is not an instance of SendMailToEmployeeTask.');
        }
    }
}
