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
use JWeiland\Telephonedirectory\Domain\Model\Employee;
use JWeiland\Telephonedirectory\Domain\Repository\EmployeeRepository;
use JWeiland\Telephonedirectory\Service\EmailService;
use TYPO3\CMS\Core\Domain\Repository\PageRepository;
use TYPO3\CMS\Core\TimeTracker\TimeTracker;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Object\ObjectManager;
use TYPO3\CMS\Extbase\Persistence\QueryResultInterface;
use TYPO3\CMS\Fluid\View\StandaloneView;
use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;
use TYPO3\CMS\Frontend\Controller\TypoScriptFrontendController;
use TYPO3\CMS\Scheduler\Task\AbstractTask;

/**
 * Send a mail to employee to re-check his data
 */
class SendMailToEmployeeTask extends AbstractTask
{
    /**
     * @var ObjectManager
     */
    protected $objectManager;

    /**
     * @var ExtConf
     */
    protected $extConf;

    /**
     * @var string
     */
    public $storagePid = '';

    /**
     * @var string
     */
    public $detailViewPid = '';

    /**
     * @return bool
     */
    public function execute(): bool
    {
        $this->objectManager = $this->getObjectManager();
        $this->extConf = $this->objectManager->get(ExtConf::class);
        $employeeRepository = $this->getObjectManager()->get(EmployeeRepository::class);
        $emailService = GeneralUtility::makeInstance(EmailService::class);

        /** @var QueryResultInterface $employees */
        $employees = $employeeRepository->findByPid($this->storagePid);
        $employees->getQuery()->getQuerySettings()->setRespectStoragePage(false);

        /**
         * @var $employee Employee
         */
        foreach ($employees as $employee) {
            $emailService->informEmployeeAboutTheirData($employee, $this->generateContent($employee));
        }

        return true;
    }

    /**
     * Generates content for email
     *
     * @param Employee $employee
     * @return string
     */
    protected function generateContent(Employee $employee): string
    {
        $view = GeneralUtility::makeInstance(StandaloneView::class);
        $view->setTemplatePathAndFilename(ExtensionManagementUtility::extPath('telephonedirectory') . 'Resources/Private/Templates/Mail/EditEmployee.html');
        $view->setPartialRootPaths([10, ExtensionManagementUtility::extPath('telephonedirectory') . 'Resources/Private/Partials/']);

        if (!is_object($GLOBALS['TT'])) {
            $GLOBALS['TT'] = GeneralUtility::makeInstance(TimeTracker::class);
            $GLOBALS['TT']->start();
        }

        $GLOBALS['TSFE'] = GeneralUtility::makeInstance(TypoScriptFrontendController::class, $GLOBALS['TYPO3_CONF_VARS'], 1, 0);
        $GLOBALS['TSFE']->sys_page = GeneralUtility::makeInstance(PageRepository::class);
        $GLOBALS['TSFE']->initTemplate();

        /** @var ContentObjectRenderer $contentObjectRenderer */
        $contentObjectRenderer = GeneralUtility::makeInstance(ContentObjectRenderer::class);
        $params = [
            'tx_telephonedirectory_telephone' => [
                'action' => 'edit',
                'controller' => 'Employee',
                'employee' => $employee->getUid(),
                'authToken' => GeneralUtility::stdAuthCode($employee)
            ]
        ];
        $linkConf = [
            'parameter' => $this->detailViewPid,
            'useCacheHash' => 1,
            'forceAbsoluteUrl' => 1,
            'additionalParams' => '&' . http_build_query($params),
            'linkAccessRestrictedPages' => 1
        ];
        $link = $contentObjectRenderer->typoLink_URL($linkConf);

        $view->assign('link', $link);
        $view->assign('employee', $employee);
        $view->assign('contactName', $this->extConf->getEmailFromName());
        $view->assign('contactEmail', $this->extConf->getEmailFromAddress());

        unset($GLOBALS['TSFE']);

        return $view->render();
    }

    /**
     * Returns object manager
     *
     * @return ObjectManager
     */
    public function getObjectManager(): ObjectManager
    {
        if (!$this->objectManager) {
            $this->objectManager = GeneralUtility::makeInstance(ObjectManager::class);
        }

        return $this->objectManager;
    }
}
