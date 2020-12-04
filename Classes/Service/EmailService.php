<?php

declare(strict_types=1);

/*
 * This file is part of the package jweiland/telephonedirectory.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace JWeiland\Telephonedirectory\Service;

use JWeiland\Telephonedirectory\Configuration\ExtConf;
use JWeiland\Telephonedirectory\Domain\Model\Employee;
use TYPO3\CMS\Core\Mail\MailMessage;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;

/**
 * Send an information mail to employees email address
 */
class EmailService
{
    /**
     * @var ExtConf
     */
    protected $extConf;

    public function __construct()
    {
        $this->extConf = GeneralUtility::makeInstance(ExtConf::class);
    }

    /**
     * Sends an email to an employee about their current data and an edit link
     *
     * @param Employee $employee
     * @param string $content
     * @throws \Exception
     */
    public function informEmployeeAboutTheirData(Employee $employee, string $content): void
    {
        /** @var MailMessage $mail */
        $mail = GeneralUtility::makeInstance(MailMessage::class);

        $mail->setFrom($this->extConf->getEmailFromAddress(), $this->extConf->getEmailFromName());
        $mail->setTo($employee->getEmail(), $employee->getFirstName() . ' ' . $employee->getLastName());
        $mail->setSubject(LocalizationUtility::translate('email.subject', 'telephonedirectory'));

        if (method_exists($mail, 'addPart')) {
            // TYPO3 < 10 (Swift_Message)
            $mail->setBody($content, 'text/html');
        } else {
            // TYPO3 >= 10 (Symfony Mail)
            $mail->html($content);
        }

        $mail->send();
    }
}
