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

    public function __construct(ExtConf $extConf)
    {
        $this->extConf = $extConf;
    }

    /**
     * Sends an email to an employee about their current data and an edit link
     *
     * @throws \Exception
     */
    public function informEmployeeAboutTheirData(array $employee, string $content): void
    {
        if (!isset($employee['email'], $employee['firstName'], $employee['lastName'])) {
            return;
        }

        if (GeneralUtility::validEmail($employee['email'])) {
            $mail = GeneralUtility::makeInstance(MailMessage::class);

            $mail->setFrom($this->extConf->getEmailFromAddress(), $this->extConf->getEmailFromName());
            $mail->setTo($employee['email'], $employee['firstName'] . ' ' . $employee['lastName']);
            $mail->setSubject(LocalizationUtility::translate('email.subject', 'telephonedirectory'));

            $mail->html($content);

            $mail->send();
        }
    }
}
