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

class BasicEmailService implements EmailServiceInterface
{
    public function sendEmail(string $to, string $subject, string $content): void
    {
        if (GeneralUtility::validEmail($to)) {
            $mail = $this->getMailMessage();
            $mail->setFrom($this->getExtConf()->getEmailFromAddress(), $this->getExtConf()->getEmailFromName());
            $mail->setTo($to);
            $mail->setSubject($subject);
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
