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
use TYPO3\CMS\Core\View\ViewFactoryData;
use TYPO3\CMS\Core\View\ViewFactoryInterface;
use TYPO3\CMS\Core\View\ViewInterface;
use TYPO3\CMS\Extbase\Mvc\RequestInterface;
use TYPO3\CMS\Extbase\Mvc\Web\Routing\UriBuilder;

class TemplateRenderingService implements EmailServiceInterface
{
    public function __construct(
        protected readonly EmployeeNotificationService $emailService,
        protected readonly UriBuilder $uriBuilder,
        protected readonly ViewFactoryInterface $viewFactory,
    ) {}

    /**
     * @param array<string, mixed> $settings
     */
    public function sendEmployeeEditMail(Employee $employee, RequestInterface $request, array $settings): void
    {
        $templatePathAndFilename = 'EXT:' . ExtConf::EXT_KEY . '/Resources/Private/Templates/Mail/EditEmployee.html';
        $view = $this->getView($templatePathAndFilename);

        $this->uriBuilder->setCreateAbsoluteUri(true);
        $this->uriBuilder->setRequest($request);

        $link = $this->uriBuilder->uriFor(
            'edit',
            [
                'controller' => 'Employee',
                'action' => 'edit',
                'employee' => $employee->getUid(),
                'hash' => $employee->getSecret(),
            ],
        );

        $view->assignMultiple([
            'link' => $link,
            'employee' => $employee,
        ]);

        $this->emailService->sendEmployeeNotification(
            $employee,
            $view->render(),
        );
    }

    public function sendEmail(string $to, string $subject, string $content): void
    {
        $this->emailService->sendEmail($to, $subject, $content);
    }

    /**
     * @param list<string> $templateRootPaths
     * @param list<string> $partialRootPaths
     * @param list<string> $layoutRootPaths
     */
    protected function getView(
        string $templatePathAndFilename,
        array $templateRootPaths = ['EXT:' . ExtConf::EXT_KEY . '/Resources/Private/Templates/'],
        array $partialRootPaths = ['EXT:' . ExtConf::EXT_KEY . '/Resources/Private/Partials/'],
        array $layoutRootPaths = ['EXT:' . ExtConf::EXT_KEY . '/Resources/Private/Layouts/'],
    ): ViewInterface {
        $viewFactoryData = new ViewFactoryData(
            templateRootPaths: $templateRootPaths,
            partialRootPaths: $partialRootPaths,
            layoutRootPaths: $layoutRootPaths,
            templatePathAndFilename: $templatePathAndFilename,
        );

        return $this->viewFactory->create($viewFactoryData);
    }
}
