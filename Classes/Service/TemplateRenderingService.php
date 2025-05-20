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
use TYPO3\CMS\Core\Crypto\HashService;
use TYPO3\CMS\Core\View\ViewFactoryData;
use TYPO3\CMS\Core\View\ViewFactoryInterface;
use TYPO3\CMS\Core\View\ViewInterface;
use TYPO3\CMS\Extbase\Mvc\RequestInterface;
use TYPO3\CMS\Extbase\Mvc\Web\Routing\UriBuilder;
use TYPO3\CMS\Extbase\Security\Exception\InvalidArgumentForHashGenerationException;

class TemplateRenderingService implements EmailServiceInterface
{
    public function __construct(
        protected EmployeeNotificationService $emailService,
        protected UriBuilder $uriBuilder,
        protected HashService $hashService,
        protected ViewFactoryInterface $viewFactory,
    ) {}

    /**
     * @param array<string, mixed> $settings
     * @throws InvalidArgumentForHashGenerationException
     */
    public function sendEmployeeEditMail(Employee $employee, RequestInterface $request, array $settings): void
    {
        $view = $this->getView();
        $view->getRenderingContext()->getLayoutPaths()->setLayoutRootPaths(['EXT:telephonedirectory/Resources/Private/Layouts/']);
        $view->getRenderingContext()->getPartialPaths()->setPartialRootPaths(['EXT:telephonedirectory/Resources/Private/Partials/']);
        $view->getRenderingContext()->setTemplatePathAndFilename(
            'EXT:telephonedirectory/Resources/Private/Templates/Mail/EditEmployee.html',
        );

        $this->uriBuilder->setCreateAbsoluteUri(true);
        $this->uriBuilder->setRequest($request);
        $additionalSecret = 'userInfo';
        $link = $this->uriBuilder->uriFor(
            'edit',
            [
                'controller' => 'Employee',
                'action' => 'edit',
                'employee' => $employee->getUid(),
                'hash' => $this->hashService->hmac('Employee:' . $employee->getUid(), $additionalSecret),
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

    protected function getView(): ViewInterface
    {
        $viewFactoryData = new ViewFactoryData();

        return $this->viewFactory->create($viewFactoryData);
    }
}
