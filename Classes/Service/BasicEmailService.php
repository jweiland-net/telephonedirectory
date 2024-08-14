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
    private string $fromName;
    private string $fromAddress;

    public function __construct(ExtConf $extConf)
    {
        $this->fromName = $extConf->getEmailFromName();
        $this->fromAddress = $extConf->getEmailFromAddress();
    }

    public function sendEmail(string $to, string $subject, string $content): void
    {
        if (GeneralUtility::validEmail($to)) {
            $mail = GeneralUtility::makeInstance(MailMessage::class);
            $mail->setFrom($this->fromAddress, $this->fromName);
            $mail->setTo($to);
            $mail->setSubject($subject);
            $mail->html($content);
            $mail->send();
        }
    }
}
