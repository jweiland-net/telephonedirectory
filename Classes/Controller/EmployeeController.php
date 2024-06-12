<?php

declare(strict_types=1);

/*
 * This file is part of the package jweiland/telephonedirectory.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace JWeiland\Telephonedirectory\Controller;

use JWeiland\Telephonedirectory\Configuration\ExtConf;
use JWeiland\Telephonedirectory\Domain\Model\Employee;
use JWeiland\Telephonedirectory\Domain\Model\Office;
use JWeiland\Telephonedirectory\Domain\Repository\BuildingRepository;
use JWeiland\Telephonedirectory\Domain\Repository\CategoryRepository;
use JWeiland\Telephonedirectory\Domain\Repository\DepartmentRepository;
use JWeiland\Telephonedirectory\Domain\Repository\EmployeeRepository;
use JWeiland\Telephonedirectory\Domain\Repository\LanguageRepository;
use JWeiland\Telephonedirectory\Domain\Repository\OfficeRepository;
use JWeiland\Telephonedirectory\Domain\Repository\SubjectFieldRepository;
use JWeiland\Telephonedirectory\Property\TypeConverter\UploadMultipleFilesConverter;
use JWeiland\Telephonedirectory\Service\EmailService;
use JWeiland\Telephonedirectory\Utility\LanguageSkillUtility;
use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Extbase\Mvc\Controller\MvcPropertyMappingConfiguration;
use TYPO3\CMS\Extbase\Mvc\Exception\StopActionException;
use TYPO3\CMS\Extbase\Property\TypeConverterInterface;
use TYPO3\CMS\Extbase\Security\Cryptography\HashService;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;
use TYPO3\CMS\Fluid\View\StandaloneView;

/**
 * Main controller to list and show employees
 */
class EmployeeController extends ActionController
{
    protected EmployeeRepository $employeeRepository;

    protected BuildingRepository $buildingRepository;

    protected DepartmentRepository $departmentRepository;

    protected OfficeRepository $officeRepository;

    protected LanguageRepository $languageRepository;

    protected SubjectFieldRepository $subjectFieldRepository;

    protected CategoryRepository $categoryRepository;

    protected ExtConf $extConf;

    protected EmailService $emailService;

    public function injectEmployeeRepository(EmployeeRepository $employeeRepository): void
    {
        $this->employeeRepository = $employeeRepository;
    }

    public function injectBuildingRepository(BuildingRepository $buildingRepository): void
    {
        $this->buildingRepository = $buildingRepository;
    }

    public function injectDepartmentRepository(DepartmentRepository $departmentRepository): void
    {
        $this->departmentRepository = $departmentRepository;
    }

    public function injectOfficeRepository(OfficeRepository $officeRepository): void
    {
        $this->officeRepository = $officeRepository;
    }

    public function injectLanguageRepository(LanguageRepository $languageRepository): void
    {
        $this->languageRepository = $languageRepository;
    }

    public function injectSubjectFieldRepository(SubjectFieldRepository $subjectFieldRepository): void
    {
        $this->subjectFieldRepository = $subjectFieldRepository;
    }

    /**
    public function injectCategoryRepository(CategoryRepository $categoryRepository): void
    {
        $this->categoryRepository = $categoryRepository;
    }**/

    public function injectExtConf(ExtConf $extConf): void
    {
        $this->extConf = $extConf;
    }

    public function injectHashService(HashService $hashService): void
    {
        $this->hashService = $hashService;
    }

    public function injectEmailService(EmailService $emailService): void
    {
        $this->emailService = $emailService;
    }

    public function initializeAction(): void
    {
        // if this value was not set, then it will be filled with 0
        // but that is not good, because UriBuilder accepts 0 as pid, so it's better to set it to null
        if (empty($this->settings['pidOfDetailPage'])) {
            $this->settings['pidOfDetailPage'] = null;
        }
    }

    public function listAction(): ResponseInterface
    {
        $employees = $this->employeeRepository->findAll();
        $this->view->assign('employees', $employees);
        $this->view->assign('offices', $this->officeRepository->findAll());

        return $this->htmlResponse();
    }

    /**
     * If an office is set, f:form.select changes name to [office][__identity]
     * The following request works, but if customer changes office back to "" an empty __identity was send
     * Now extbase tries to get an object of a non given UID which results in multiple errors
     * That's why we remove this request here
     */
    public function initializeSearchAction()
    {
        if ($this->request->hasArgument('office')) {
            $office = $this->request->getArgument('office');
            if (isset($office['__identity']) && empty($office['__identity'])) {
                $this->request = $this->request->withArgument('office', '');
            }
        }
    }

    public function searchAction(Office $office = null, string $search = ''): ResponseInterface
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

        return $this->htmlResponse();
    }

    public function showAction(Employee $employee): ResponseInterface
    {
        $this->view->assign('contactEmail', $this->extConf->getEmailContact());
        $this->view->assign('employee', $employee);

        return $this->htmlResponse();
    }

    public function showRecordsAction(): ResponseInterface
    {
        $this->view->assignMultiple([
            'contactEmail' => $this->extConf->getEmailContact(),
            'employees' => $this->employeeRepository->findEmployees(
                $this->settings['showRecords'] ?? ''
            )
        ]);

        return $this->htmlResponse();
    }

    public function newAction(Employee $newEmployee = null): ResponseInterface
    {
        $this->view->assign('newEmployee', $newEmployee);

        return $this->htmlResponse();
    }

    public function createAction(Employee $newEmployee): ResponseInterface
    {
        $this->employeeRepository->add($newEmployee);
        $this->addFlashMessage(LocalizationUtility::translate('employeeCreated', 'telephonedirectory'));
        $this->redirect('list');

        return $this->htmlResponse();
    }

    public function editAction(Employee $employee): ResponseInterface
    {
        if (!$employee->getIsCatchAllMail()) {
            $hash = $this->request->getArgument('hash');

            if ($this->hashService->validateHmac('Employee:' . $employee->getUid(), $hash)) {
                $this->view->assignMultiple(
                    [
                        'employee' => $employee,
                        'buildings' => $this->buildingRepository->findAll(),
                        'subjectFields' => $this->subjectFieldRepository->findAll(),
                        'departments' => $this->departmentRepository->findAll(),
                        'offices' => $this->officeRepository->findAll(),
                        'languages' => $this->languageRepository->findAll(),
                        'languageSkills' => LanguageSkillUtility::getLanguageSkillsForFluidSelect(),
                        'additionalFunctions' => $this->categoryRepository->findByParent(
                            $this->extConf->getAdditionalFunctionsParentCategoryUid()
                        ),
                        'checkFalUploadEnabled' => ExtensionManagementUtility::isLoaded('checkfaluploads')
                    ]
                );
            }
        }

        return $this->htmlResponse();
    }

    public function initializeUpdateAction(): ResponseInterface
    {
        $this->arguments->getArgument('employee')->getPropertyMappingConfiguration()->allowProperties('languageSkill');
        $this->arguments->getArgument('employee')->getPropertyMappingConfiguration()->forProperty('languageSkill.*')->allowProperties('language', 'writing', 'speaking');
        $this->arguments->getArgument('employee')->getPropertyMappingConfiguration()->allowCreationForSubProperty('languageSkill.*');
        $this->arguments->getArgument('employee')->getPropertyMappingConfiguration()->allowModificationForSubProperty('languageSkill.*');

        $employeeMappingConfiguration = $this->arguments
            ->getArgument('employee')
            ->getPropertyMappingConfiguration();

        /** @var Employee $persistedEmployee */
        $persistedEmployee = $this->employeeRepository->findByIdentifier($this->request->getArgument('employee')['__identity']);
        $this->assignMediaTypeConverter('image', $employeeMappingConfiguration, $persistedEmployee->getImage());

        return $this->htmlResponse();
    }

    public function updateAction(Employee $employee): ResponseInterface
    {
        $this->employeeRepository->update($employee);
        $this->addFlashMessage(LocalizationUtility::translate('employeeUpdated', 'telephonedirectory'));

        return $this->redirect('show', 'Employee', 'telephonedirectory', ['employee' => $employee]);
    }

    /**
     * Send a mail with link to edit this entry
     *
     * @throws StopActionException
     */
    public function sendEditMailAction(Employee $employee): ResponseInterface
    {
        try {
            $this->emailService->informEmployeeAboutTheirData(
                [
                    'email' => $employee->getEmail(),
                    'firstName' => $employee->getFirstName(),
                    'lastName' => $employee->getLastName(),
                ],
                $this->getContent($employee)
            );
            $this->addFlashMessage(LocalizationUtility::translate('emailWasSend', 'telephonedirectory'));
        } catch (\Exception $e) {
        }

        return $this->redirect(
            'show',
            'Employee',
            'telephonedirectory',
            ['employee' => $employee]
        );
    }

    /**
     * Get content for mailing
     */
    protected function getContent(Employee $employee): string
    {
        $view = GeneralUtility::makeInstance(StandaloneView::class);
        $view->setTemplatePathAndFilename(
            'EXT:telephonedirectory/Resources/Private/Templates/Mail/EditEmployee.html'
        );
        $view->setRequest($this->request);

        $this->uriBuilder->setCreateAbsoluteUri(true);
        $link = $this->uriBuilder->uriFor(
            'edit',
            [
                'parameter' => $this->settings['pidOfDetailPage'],
                'hash' => $this->hashService->generateHmac('Employee:' . $employee->getUid()),
                'action' => 'edit',
                'controller' => 'Employee',
                'employee' => $employee->getUid()
            ]
        );

        $view->assign('link', $link);
        $view->assign('employee', $employee);

        return $view->render();
    }

    /**
     * Currently only "image" are allowed properties.
     *
     * @param mixed $converterOptionValue
     */
    protected function assignMediaTypeConverter(
        string $property,
        MvcPropertyMappingConfiguration $propertyMappingConfigurationForEmployee,
        $converterOptionValue
    ): void {
        if ($property === 'image') {
            $className = UploadMultipleFilesConverter::class;
            $converterOptionName = 'IMAGES';
        } else {
            return;
        }

        /** @var TypeConverterInterface $typeConverter */
        $typeConverter = GeneralUtility::makeInstance($className);
        $propertyMappingConfigurationForMediaFiles = $propertyMappingConfigurationForEmployee
            ->forProperty($property)
            ->setTypeConverter($typeConverter);

        $propertyMappingConfigurationForMediaFiles->setTypeConverterOption(
            $className,
            'settings',
            $this->settings
        );

        if (!empty($converterOptionValue)) {
            // Do not use setTypeConverterOptions() as this will remove all existing options
            $propertyMappingConfigurationForMediaFiles->setTypeConverterOption(
                $className,
                $converterOptionName,
                $converterOptionValue
            );
        }
    }
}
