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
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Mvc\RequestInterface;
use TYPO3\CMS\Extbase\Mvc\Web\Routing\UriBuilder;
use TYPO3\CMS\Extbase\Security\Cryptography\HashService;
use TYPO3\CMS\Extbase\Security\Exception\InvalidArgumentForHashGenerationException;
use TYPO3\CMS\Fluid\View\StandaloneView;

class TemplateRenderingService implements EmailServiceInterface
{
    public function __construct(
        protected EmployeeNotificationService $emailService,
        protected UriBuilder $uriBuilder,
        protected HashService $hashService,
    ) {}

    /**
     * @param array<string, mixed> $settings
     * @throws InvalidArgumentForHashGenerationException
     */
    public function sendEmployeeEditMail(Employee $employee, RequestInterface $request, array $settings): void
    {
        $view = $this->getView();
        $view->setLayoutRootPaths(['EXT:telephonedirectory/Resources/Private/Layouts/']);
        $view->setPartialRootPaths(['EXT:telephonedirectory/Resources/Private/Partials/']);
        $view->setTemplatePathAndFilename(
            'EXT:telephonedirectory/Resources/Private/Templates/Mail/EditEmployee.html',
        );
        $view->setRequest($request);

        $this->uriBuilder->setCreateAbsoluteUri(true);
        $this->uriBuilder->setRequest($request);
        $link = $this->uriBuilder->uriFor(
            'edit',
            [
                'controller' => 'Employee',
                'action' => 'edit',
                'employee' => $employee->getUid(),
                'hash' => $this->hashService->generateHmac('Employee:' . $employee->getUid()),
            ],
        );

        $view->assign('link', $link);
        $view->assign('employee', $employee);

        $this->emailService->sendEmployeeNotification(
            $employee,
            $view->render(),
        );
    }

    public function sendEmail(string $to, string $subject, string $content): void
    {
        $this->emailService->sendEmail($to, $subject, $content);
    }

    protected function getView(): StandaloneView
    {
        return GeneralUtility::makeInstance(StandaloneView::class);
    }
}
