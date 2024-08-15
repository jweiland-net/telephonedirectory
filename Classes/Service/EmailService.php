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
use TYPO3\CMS\Extbase\Mvc\Web\Routing\UriBuilder;
use TYPO3\CMS\Extbase\Security\Cryptography\HashService;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;

/**
 * Send an information mail to employees email address
 */
class EmailService
{
    public function __construct(protected UriBuilder $uriBuilder, protected readonly HashService $hashService) {}

    /**
     * Sends an email to an employee about their current data and an edit link
     *
     * @param array<string, mixed> $employee
     * @throws \Exception
     */
    public function informEmployeeAboutTheirData(array $employee, string $content): void
    {
        if (!isset($employee['email'], $employee['firstName'], $employee['lastName'])) {
            return;
        }

        if (GeneralUtility::validEmail($employee['email'])) {
            $mail = $this->getMailMessage();
            $mail->setFrom($this->getExtConf()->getEmailFromAddress(), $this->getExtConf()->getEmailFromName());
            $mail->setTo($employee['email'], $employee['firstName'] . ' ' . $employee['lastName']);
            $mail->setSubject(LocalizationUtility::translate('email.subject', 'telephonedirectory'));
            $mail->html($content);
            $mail->send();
        }
    }

    protected function getExtConf(): ExtConf
    {
        return GeneralUtility::makeInstance(ExtConf::class);
    }

    protected function getMailMessage(): MailMessage
    {
        return GeneralUtility::makeInstance(MailMessage::class);
    }
}
