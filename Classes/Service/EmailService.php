<?php
declare(strict_types=1);
namespace JWeiland\Telephonedirectory\Service;

/*
 * This file is part of the telephonedirectory project.
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

use JWeiland\Telephonedirectory\Configuration\ExtConf;
use JWeiland\Telephonedirectory\Domain\Model\Employee;
use TYPO3\CMS\Core\Mail\MailMessage;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;

/**
 * Class EmailService
 *
 * @package JWeiland\Telephonedirectory\Service
 */
class EmailService
{
    /**
     * extConf
     *
     * @var ExtConf
     */
    protected $extConf;

    /**
     * EmailService constructor
     */
    public function __construct()
    {
        $this->extConf = GeneralUtility::makeInstance(ExtConf::class);
    }

    /**
     * Sends an email to an employee about their current data and an edit link
     *
     * @param Employee $employee
     * @param string $content
     *
     * @return void
     *
     * @throws \Exception
     */
    public function informEmployeeAboutTheirData(Employee $employee, $content)
    {
        /** @var MailMessage $mail */
        $mail = GeneralUtility::makeInstance(MailMessage::class);

        $mail->setFrom($this->extConf->getEmailFromAddress(), $this->extConf->getEmailFromName());
        $mail->setTo($employee->getEmail(), $employee->getFirstName() . ' ' . $employee->getLastName());
        $mail->setSubject(LocalizationUtility::translate('email.subject', 'telephonedirectory'));
        $mail->setBody((string)$content, 'text/html');
        $mail->send();
    }
}
