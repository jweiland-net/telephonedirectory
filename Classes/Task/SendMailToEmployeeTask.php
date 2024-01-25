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
use TYPO3\CMS\Extbase\Security\Cryptography\HashService;
use TYPO3\CMS\Extbase\Security\Exception\InvalidArgumentForHashGenerationException;
use TYPO3\CMS\Fluid\View\StandaloneView;
use TYPO3\CMS\Scheduler\Task\AbstractTask;

/**
 * Send a mail to employee to re-check his data
 */
class SendMailToEmployeeTask extends AbstractTask
{
    /**
     * @var int
     */
    public $storagePid = 0;

    /**
     * @var int
     */
    public $detailViewPid = 0;

    public function execute(): bool
    {
        $emailService = $this->getEmailService();
        $employeeFactory = $this->getEmployeeFactory();

        foreach ($employeeFactory->getEmployees((string)$this->storagePid, true) as $employeeUid) {
            try {
                $employee = $employeeFactory->build($employeeUid);
                $emailService->informEmployeeAboutTheirData(
                    $employee,
                    $this->generateContent($employee)
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
     * @throws \Exception
     */
    protected function generateContent(array $employee): string
    {
        $view = $this->getView();
        $view->assign('link', $this->getEditLink((int)$employee['uid']));
        $view->assign('employee', $employee);
        $view->assign('contactName', $this->getExtConf()->getEmailFromName());
        $view->assign('contactEmail', $this->getExtConf()->getEmailContact());

        return $view->render();
    }

    private function getView(): StandaloneView
    {
        $view = GeneralUtility::makeInstance(StandaloneView::class);

        $view->setTemplatePathAndFilename(
            $this->getResolvedExtPath('EXT:telephonedirectory/Resources/Private/Templates/Mail/EditEmployee.html')
        );
        $view->setPartialRootPaths([
            $this->getResolvedExtPath('EXT:telephonedirectory/Resources/Private/Partials/'),
        ]);

        return $view;
    }

    /**
     * @throws InvalidArgumentForHashGenerationException
     */
    private function getEditLink(int $employeeUid): string
    {
        $site = $this->getSite($this->detailViewPid);
        if (!$site instanceof Site) {
            return '';
        }

        return (string)$site->getRouter()->generateUri(
            $this->detailViewPid,
            [
                'tx_telephonedirectory_telephone' => [
                    'action' => 'edit',
                    'controller' => 'Employee',
                    'employee' => $employeeUid,
                    'hash' => $this->getHashService()->generateHmac('Employee:' . $employeeUid)
                ]
            ]
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
        } catch (SiteNotFoundException $e) {
        }

        return null;
    }

    private function getSiteFinder(): SiteFinder
    {
        return GeneralUtility::makeInstance(SiteFinder::class);
    }

    private function getHashService(): HashService
    {
        return GeneralUtility::makeInstance(HashService::class);
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
