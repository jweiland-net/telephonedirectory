<?php

declare(strict_types=1);

/*
 * This file is part of the package jweiland/telephonedirectory.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace JWeiland\Telephonedirectory\Controller;

use JWeiland\Telephonedirectory\Domain\Model\Employee;
use JWeiland\Telephonedirectory\Domain\Model\Office;
use JWeiland\Telephonedirectory\Traits\InjectBuildingRepositoryTrait;
use JWeiland\Telephonedirectory\Traits\InjectCategoryRepositoryTrait;
use JWeiland\Telephonedirectory\Traits\InjectDepartmentRepositoryTrait;
use JWeiland\Telephonedirectory\Traits\InjectEmployeeRepositoryTrait;
use JWeiland\Telephonedirectory\Traits\InjectExtConfTrait;
use JWeiland\Telephonedirectory\Traits\InjectLanguageRepositoryTrait;
use JWeiland\Telephonedirectory\Traits\InjectOfficeRepositoryTrait;
use JWeiland\Telephonedirectory\Traits\InjectPropertyMappingConfiguratorTrait;
use JWeiland\Telephonedirectory\Traits\InjectSubjectFieldRepositoryTrait;
use JWeiland\Telephonedirectory\Traits\InjectTemplateServiceTrait;
use JWeiland\Telephonedirectory\Traits\MediaTypeConverterTrait;
use JWeiland\Telephonedirectory\Utility\LanguageSkillUtility;
use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;

/**
 * Main controller to list and show employees
 */
class EmployeeController extends AbstractController
{
    use InjectCategoryRepositoryTrait;
    use InjectBuildingRepositoryTrait;
    use InjectDepartmentRepositoryTrait;
    use InjectEmployeeRepositoryTrait;
    use InjectExtConfTrait;
    use InjectLanguageRepositoryTrait;
    use InjectOfficeRepositoryTrait;
    use InjectPropertyMappingConfiguratorTrait;
    use InjectSubjectFieldRepositoryTrait;
    use InjectTemplateServiceTrait;
    use MediaTypeConverterTrait;

    public function initializeListAction(): void
    {
        $this->initializeControllerAction();
    }

    /**
     * @param array<string, mixed> $search
     */
    public function listAction(array $search = []): ResponseInterface
    {
        $office = $this->settings['filterByOffice'] ?? null;
        if ((int)$office === 0) {
            $office = null;
        }

        $this->postProcessAndAssignFluidVariables([
            'employees' => $this->employeeRepository->findFilteredBy($office, $search),
            'offices' => $this->officeRepository->findAll(),
        ]);

        return $this->htmlResponse();
    }

    /**
     * If an office is set, f:form.select changes name to [office][__identity]
     * The following request works,
     * but if customer changes office back to "" an empty __identity was send
     * Now extbase tries to get an object of a non given UID which results in multiple errors
     * That's why we remove this request here
     */
    public function initializeSearchAction(): void
    {
        if ($this->request->hasArgument('office')) {
            $office = $this->request->getArgument('office');
            if (isset($office['__identity']) && empty($office['__identity'])) {
                $this->request = $this->request->withArgument('office', '');
            }
        }

        $this->initializeControllerAction();
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

    public function initializeShowAction(): void
    {
        $this->initializeControllerAction();
    }

    public function showAction(Employee $employee): ResponseInterface
    {
        $this->view->assign('contactEmail', $this->extConf->getEmailContact());
        $this->view->assign('employee', $employee);

        return $this->htmlResponse();
    }

    public function initializeShowRecordsAction(): void
    {
        $this->initializeControllerAction();
    }

    public function showRecordsAction(): ResponseInterface
    {
        $this->view->assignMultiple([
            'contactEmail' => $this->extConf->getEmailContact(),
            'employees' => $this->employeeRepository->findEmployees(
                $this->settings['showRecords'] ?? '',
            ),
        ]);

        return $this->htmlResponse();
    }

    public function initializeNewAction(): void
    {
        $this->initializeControllerAction();
    }

    public function newAction(Employee $newEmployee = null): ResponseInterface
    {
        $this->preProcessControllerAction();
        $this->view->assign('newEmployee', $newEmployee);

        return $this->htmlResponse();
    }

    public function initializeCreateAction(): void
    {
        $this->initializeControllerAction();
    }

    public function createAction(Employee $newEmployee): ResponseInterface
    {
        $this->employeeRepository->add($newEmployee);
        $this->addFlashMessage(LocalizationUtility::translate('employeeCreated', 'telephonedirectory'));
        $this->redirect('list');

        return $this->htmlResponse();
    }

    public function initializeEditAction(): void
    {
        $this->initializeControllerAction();
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
                        'additionalFunctions' => $this->categoryRepository->findBy(
                            ['parent' => $this->extConf->getAdditionalFunctionsParentCategoryUid()],
                        ),
                        'checkFalUploadEnabled' => ExtensionManagementUtility::isLoaded('checkfaluploads'),
                    ],
                );
            }
        }

        return $this->htmlResponse();
    }

    public function initializeUpdateAction(): void
    {
        $employeeMappingConfiguration = $this->arguments->getArgument('employee')->getPropertyMappingConfiguration();
        $this->propertyMappingConfigurator->configureEmployeeMapping($employeeMappingConfiguration);

        $persistedEmployee = $this->employeeRepository->findByIdentifier(
            $this->request->getArgument('employee')['__identity'],
        );
        $this->assignMediaTypeConverter(
            'image',
            $employeeMappingConfiguration,
            $persistedEmployee->getImage(),
            $this->settings,
        );

        $this->initializeControllerAction();
    }

    public function updateAction(Employee $employee): ResponseInterface
    {
        $this->employeeRepository->update($employee);
        $this->addFlashMessage(LocalizationUtility::translate('employeeUpdated', 'telephonedirectory'));

        return $this->redirect(
            'show',
            'Employee',
            'telephonedirectory',
            ['employee' => $employee],
        );
    }

    public function initializeSendEditMailAction(): void
    {
        $this->initializeControllerAction();
    }

    public function sendEditMailAction(Employee $employee): ResponseInterface
    {
        try {
            $this->templateRenderingService->sendEmployeeEditMail($employee, $this->request, $this->settings);
            $this->addFlashMessage(LocalizationUtility::translate('emailWasSend', 'telephonedirectory'));
        } catch (\Exception $e) {
        }

        return $this->redirect(
            'show',
            'Employee',
            'telephonedirectory',
            ['employee' => $employee],
        );
    }
}
