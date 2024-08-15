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
use TYPO3\CMS\Extbase\Mvc\RequestInterface;
use TYPO3\CMS\Extbase\Mvc\Web\Routing\UriBuilder;
use TYPO3\CMS\Extbase\Security\Cryptography\HashService;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;
use TYPO3\CMS\Fluid\View\StandaloneView;

/**
 * Send an information mail to employees email address
 */
class EmailService
{
    protected ExtConf $extConf;
    protected UriBuilder $uriBuilder;

    /**
     * @var array<string, mixed> $settings
     */
    protected array $settings = [];

    /**
     * @param array<string, mixed> $settings
     */
    public function __construct(
        ExtConf $extConf,
        UriBuilder $uriBuilder,
        array $settings,
        protected readonly HashService $hashService,
    ) {
        $this->extConf = $extConf;
        $this->uriBuilder = $uriBuilder;
        $this->settings = $settings;
    }

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
            $mail = GeneralUtility::makeInstance(MailMessage::class);

            $mail->setFrom($this->extConf->getEmailFromAddress(), $this->extConf->getEmailFromName());
            $mail->setTo($employee['email'], $employee['firstName'] . ' ' . $employee['lastName']);
            $mail->setSubject(LocalizationUtility::translate('email.subject', 'telephonedirectory'));

            $mail->html($content);

            $mail->send();
        }
    }

    public function sendEditMail(Employee $employee, RequestInterface $request): void
    {
        $view = GeneralUtility::makeInstance(StandaloneView::class);
        $view->setLayoutRootPaths(['EXT:telephonedirectory/Resources/Private/Layouts/']);
        $view->setPartialRootPaths(['EXT:telephonedirectory/Resources/Private/Partials/']);
        $view->setTemplatePathAndFilename('EXT:telephonedirectory/Resources/Private/Templates/Mail/EditEmployee.html');
        $view->setRequest($request);

        $this->uriBuilder->setCreateAbsoluteUri(true);
        $this->uriBuilder->setRequest($request);
        $link = $this->uriBuilder->uriFor(
            'edit',
            [
                'parameter' => $this->settings['pidOfDetailPage'],
                'hash' => $this->hashService->generateHmac('Employee:' . $employee->getUid()),
                'action' => 'edit',
                'controller' => 'Employee',
                'employee' => $employee->getUid(),
            ],
        );

        $view->assign('link', $link);
        $view->assign('employee', $employee);

        $this->informEmployeeAboutTheirData(
            [
                'email' => $employee->getEmail(),
                'firstName' => $employee->getFirstName(),
                'lastName' => $employee->getLastName(),
            ],
            $view->render(),
        );
    }
}
