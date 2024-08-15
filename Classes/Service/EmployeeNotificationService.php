<?php

declare(strict_types=1);

/*
 * This file is part of the package jweiland/telephonedirectory.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace JWeiland\Telephonedirectory\Service;

use JWeiland\Telephonedirectory\Domain\Model\Employee;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;

class EmployeeNotificationService implements EmailServiceInterface
{
    public function __construct(protected readonly BasicEmailService $emailService) {}

    public function sendEmployeeNotification(Employee $employee, string $content): void
    {
        $subject = LocalizationUtility::translate('email.subject', 'telephonedirectory');
        $to = $employee->getEmail();
        $this->emailService->sendEmail($to, $subject, $content);
    }

    public function sendEmail(string $to, string $subject, string $content): void
    {
        $this->emailService->sendEmail($to, $subject, $content);
    }
}
