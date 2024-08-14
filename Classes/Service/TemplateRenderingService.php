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
use TYPO3\CMS\Extbase\Mvc\RequestInterface;
use TYPO3\CMS\Extbase\Mvc\Web\Routing\UriBuilder;
use TYPO3\CMS\Extbase\Security\Cryptography\HashService;
use TYPO3\CMS\Extbase\Security\Exception\InvalidArgumentForHashGenerationException;
use TYPO3\CMS\Fluid\View\StandaloneView;

class TemplateRenderingService implements EmailServiceInterface
{
    protected EmailServiceInterface $emailService;
    protected StandaloneView $view;
    protected UriBuilder $uriBuilder;
    protected HashService $hashService;

    public function __construct(
        EmployeeNotificationService $emailService,
        StandaloneView $view,
        UriBuilder $uriBuilder,
        HashService $hashService,
    ) {
        $this->emailService = $emailService;
        $this->view = $view;
        $this->uriBuilder = $uriBuilder;
        $this->hashService = $hashService;
    }

    /**
     * @param array<string, mixed> $settings
     * @throws InvalidArgumentForHashGenerationException
     */
    public function sendEmployeeEditMail(Employee $employee, RequestInterface $request, array $settings): void
    {
        $this->view->setLayoutRootPaths(['EXT:telephonedirectory/Resources/Private/Layouts/']);
        $this->view->setPartialRootPaths(['EXT:telephonedirectory/Resources/Private/Partials/']);
        $this->view->setTemplatePathAndFilename(
            'EXT:telephonedirectory/Resources/Private/Templates/Mail/EditEmployee.html',
        );
        $this->view->setRequest($request);

        $this->uriBuilder->setCreateAbsoluteUri(true);
        $this->uriBuilder->setRequest($request);
        $link = $this->uriBuilder->uriFor(
            'edit',
            [
                'parameter' => $settings['pidOfDetailPage'],
                'hash' => $this->hashService->generateHmac('Employee:' . $employee->getUid()),
                'action' => 'edit',
                'controller' => 'Employee',
                'employee' => $employee->getUid(),
            ],
        );

        $this->view->assign('link', $link);
        $this->view->assign('employee', $employee);

        $content = $this->view->render();

        $this->emailService->sendEmployeeNotification(
            $employee,
            $content,
        );
    }

    public function sendEmail(string $to, string $subject, string $content): void
    {
        $this->emailService->sendEmail($to, $subject, $content);
    }
}
