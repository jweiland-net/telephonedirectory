<?php
namespace JWeiland\Telephonedirectory\Controller;

/*
 * This file is part of the TYPO3 CMS project.
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
use JWeiland\Telephonedirectory\Domain\Model\Office;
use JWeiland\Telephonedirectory\Domain\Repository\BuildingRepository;
use JWeiland\Telephonedirectory\Domain\Repository\DepartmentRepository;
use JWeiland\Telephonedirectory\Domain\Repository\EmployeeRepository;
use JWeiland\Telephonedirectory\Domain\Repository\OfficeRepository;
use JWeiland\Telephonedirectory\Service\EmailService;
use TYPO3\CMS\Core\Mail\MailMessage;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;
use TYPO3\CMS\Fluid\View\StandaloneView;

/**
 * @package telephonedirectory
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class EmployeeController extends ActionController
{
    /**
     * employeeRepository
     *
     * @var EmployeeRepository
     */
    protected $employeeRepository;

    /**
     * buildingRepository
     *
     * @var BuildingRepository
     */
    protected $buildingRepository;

    /**
     * departmentRepository
     *
     * @var DepartmentRepository
     */
    protected $departmentRepository;

    /**
     * officeRepository
     *
     * @var OfficeRepository
     */
    protected $officeRepository;

    /**
     * extConf
     *
     * @var ExtConf
     */
    protected $extConf;

    /**
     * Injects employee repository
     *
     * @param EmployeeRepository $employeeRepository
     */
    public function injectEmployeeRepository(EmployeeRepository $employeeRepository)
    {
        $this->employeeRepository = $employeeRepository;
    }

    /**
     * Injects building repository
     *
     * @param BuildingRepository $buildingRepository
     */
    public function injectBuildingRepository(BuildingRepository $buildingRepository)
    {
        $this->buildingRepository = $buildingRepository;
    }

    /**
     * Injects department repository
     *
     * @param DepartmentRepository $departmentRepository
     */
    public function injectDepartmentRepository(DepartmentRepository $departmentRepository)
    {
        $this->departmentRepository = $departmentRepository;
    }

    /**
     * Injects office repository
     *
     * @param OfficeRepository $officeRepository
     */
    public function injectOfficeRepository(OfficeRepository $officeRepository)
    {
        $this->officeRepository = $officeRepository;
    }

    /**
     * Injects ext conf
     *
     * @param ExtConf $extConf
     */
    public function injectExtConf(ExtConf $extConf)
    {
        $this->extConf = $extConf;
    }

    /**
     * preprocessing of all actions
     *
     * @return void
     */
    public function initializeAction()
    {
        // if this value was not set, then it will be filled with 0
        // but that is not good, because UriBuilder accepts 0 as pid, so it's better to set it to NULL
        if (empty($this->settings['pidOfDetailPage'])) {
            $this->settings['pidOfDetailPage'] = null;
        }
    }

    /**
     * action list
     *
     * @return void
     */
    public function listAction()
    {
        $employees = $this->employeeRepository->findAll();
        $this->view->assign('employees', $employees);
        $this->view->assign('offices', $this->officeRepository->findAll());
    }

    /**
     * if an office is set, f:form.select changes name to [office][__identity]
     * The following request works, but if customer changes office back to "" an empty __identity was send
     * Now extbase tries to get an object of a non given UID which results in multiple errors
     * Thats why we remove this request here
     *
     * @return void
     */
    public function initializeSearchAction()
    {
        if ($this->request->hasArgument('office')) {
            $office = $this->request->getArgument('office');
            if (isset($office['__identity']) && empty($office['__identity'])) {
                $this->request->setArgument('office', '');
            }
        }
    }

    /**
     * action list
     *
     * @param Office $office
     * @param string $search
     * @return void
     */
    public function searchAction(Office $office = null, $search = '')
    {
        if ($office instanceof Office || !empty($search)) {
            $employees = $this->employeeRepository->findBySearch($office, $search);
            $this->view->assign('office', $office);
            $this->view->assign('search', $search);
        } else {
            $employees = $this->employeeRepository->findAll();
        }
        $this->view->assign('employees', $employees);
        $this->view->assign('offices', $this->officeRepository->findAll());
    }

    /**
     * action show
     *
     * @param Employee $employee
     * @return void
     */
    public function showAction(Employee $employee)
    {
        $this->view->assign('employee', $employee);
    }

    /**
     * action new
     *
     * @param Employee $newEmployee
     * @dontvalidate $newEmployee
     * @return void
     */
    public function newAction(Employee $newEmployee = null)
    {
        $this->view->assign('newEmployee', $newEmployee);
    }

    /**
     * action create
     *
     * @param Employee $newEmployee
     * @return void
     */
    public function createAction(Employee $newEmployee)
    {
        $this->employeeRepository->add($newEmployee);
        $this->addFlashMessage(LocalizationUtility::translate('employeeCreated', 'telephonedirectory'));
        $this->redirect('list');
    }

    /**
     * action edit
     *
     * @param Employee $employee
     * @return void
     */
    public function editAction(Employee $employee)
    {
        $this->view->assign('employee', $employee);
        $this->view->assign('buildings', $this->buildingRepository->findAll());
        $this->view->assign('departments', $this->departmentRepository->findAll());
        $this->view->assign('offices', $this->officeRepository->findAll());
    }

    /**
     * action update
     *
     * @param Employee $employee
     * @return void
     */
    public function updateAction(Employee $employee)
    {
        $this->employeeRepository->update($employee);
        $this->addFlashMessage(LocalizationUtility::translate('employeeUpdated', 'telephonedirectory'));
        $this->redirect('list');
    }

    /**
     * send a mail with link to edit this entry
     *
     * @param Employee $employee
     */
    public function sendEditMailAction(Employee $employee)
    {
        GeneralUtility::makeInstance(EmailService::class)->informEmployeeAboutTheirData($employee, $this->getContent($employee));

        $this->addFlashMessage(LocalizationUtility::translate('emailWasSend', 'telephonedirectory'));
        $this->redirect('list');
    }

    /**
     * get content for mailing
     *
     * @param Employee $employee
     * @return string
     */
    protected function getContent(Employee $employee)
    {
        /** @var \TYPO3\CMS\Fluid\View\StandaloneView $view */
        $view = $this->objectManager->get(StandaloneView::class);
        $view->setTemplatePathAndFilename(ExtensionManagementUtility::extPath('telephonedirectory') . 'Resources/Private/Templates/Mail/EditEmployee.html');
        $view->setControllerContext($this->getControllerContext());
        $view->assign('settings', $this->settings);
        $view->assign('employee', $employee);
        return $view->render();
    }
}
