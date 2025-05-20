<?php

declare(strict_types=1);

/*
 * This file is part of the package jweiland/telephonedirectory.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace JWeiland\Telephonedirectory\Task;

use JWeiland\Telephonedirectory\Configuration\ExtConf;
use JWeiland\Telephonedirectory\Repository\EmployeeFactory;
use JWeiland\Telephonedirectory\Service\EmailService;
use TYPO3\CMS\Core\Exception\SiteNotFoundException;
use TYPO3\CMS\Core\Site\Entity\Site;
use TYPO3\CMS\Core\Site\SiteFinder;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\View\ViewFactoryData;
use TYPO3\CMS\Core\View\ViewFactoryInterface;
use TYPO3\CMS\Core\View\ViewInterface;
use TYPO3\CMS\Extbase\Security\Exception\InvalidArgumentForHashGenerationException;
use TYPO3\CMS\Scheduler\Task\AbstractTask;

/**
 * Send a mail to employee to re-check his data
 */
class SendMailToEmployeeTask extends AbstractTask
{
    public int $storagePid = 0;

    public int $detailViewPid = 0;

    public function __construct(
        private ViewFactoryInterface $viewFactory,
    ) {}

    public function execute(): bool
    {
        $emailService = $this->getEmailService();
        $employeeFactory = $this->getEmployeeFactory();

        foreach ($employeeFactory->getEmployees((string)$this->storagePid, true) as $employeeUid) {
            try {
                $employee = $employeeFactory->build($employeeUid);
                $emailService->informEmployeeAboutTheirData(
                    $employee,
                    $this->generateContent($employee),
                );
            } catch (\Exception $e) {
                return false;
            }
        }

        return true;
    }

    /**
     * Generates content for email
     *
     * @param array<string, mixed> $employee
     * @throws \Exception
     */
    protected function generateContent(array $employee): string
    {
        $view = $this->getView();
        $view->assign('link', $this->getEditLink());
        $view->assign('employee', $employee);
        $view->assign('contactName', $this->getExtConf()->getEmailFromName());
        $view->assign('contactEmail', $this->getExtConf()->getEmailContact());

        return $view->render();
    }

    private function getView(): ViewInterface
    {
        $viewFactoryData = new ViewFactoryData();
        $view = $this->viewFactory->create($viewFactoryData);

        $view->getRenderingContext()->getTemplatePaths()->setTemplatePathAndFilename(
            $this->getResolvedExtPath('EXT:telephonedirectory/Resources/Private/Templates/Mail/EditEmployee.html'),
        );
        $view->getRenderingContext()->setPartialRootPaths([
            $this->getResolvedExtPath('EXT:telephonedirectory/Resources/Private/Partials/'),
        ]);

        return $view;
    }

    /**
     * @throws InvalidArgumentForHashGenerationException
     */
    private function getEditLink(): string
    {
        $site = $this->getSite($this->detailViewPid);
        if (!$site instanceof Site) {
            return '';
        }
        return (string)$site->getRouter()->generateUri(
            $this->detailViewPid,
        );
    }

    private function getResolvedExtPath(string $filename): string
    {
        return GeneralUtility::getFileAbsFileName($filename);
    }

    private function getSite(int $pageUid): ?Site
    {
        try {
            return $this->getSiteFinder()->getSiteByPageId($pageUid);
        } catch (SiteNotFoundException $siteNotFoundException) {
        }

        return null;
    }

    private function getSiteFinder(): SiteFinder
    {
        return GeneralUtility::makeInstance(SiteFinder::class);
    }

    private function getEmployeeFactory(): EmployeeFactory
    {
        return GeneralUtility::makeInstance(EmployeeFactory::class);
    }

    private function getEmailService(): EmailService
    {
        return GeneralUtility::makeInstance(EmailService::class);
    }

    private function getExtConf(): ExtConf
    {
        return GeneralUtility::makeInstance(ExtConf::class);
    }
}
