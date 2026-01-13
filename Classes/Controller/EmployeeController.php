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
use JWeiland\Telephonedirectory\Mvc\Property\Mapping\PropertyMappingConfigurator;
use JWeiland\Telephonedirectory\Service\TemplateRenderingService;
use JWeiland\Telephonedirectory\Traits\MediaTypeConverterTrait;
use JWeiland\Telephonedirectory\Utility\LanguageSkillUtility;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;
use TYPO3\CMS\Core\Crypto\HashService;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Extbase\Persistence\Exception\InvalidQueryException;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;

/**
 * Main controller to list and show employees
 */
class EmployeeController extends AbstractController
{
    use MediaTypeConverterTrait;

    public function __construct(
        readonly protected BuildingRepository $buildingRepository,
        readonly protected CategoryRepository $categoryRepository,
        readonly protected DepartmentRepository $departmentRepository,
        readonly protected EmployeeRepository $employeeRepository,
        readonly protected ExtConf $extConf,
        protected HashService $hashService,
        readonly protected LanguageRepository $languageRepository,
        readonly protected LoggerInterface $logger,
        readonly protected OfficeRepository $officeRepository,
        readonly protected PropertyMappingConfigurator $propertyMappingConfigurator,
        readonly protected SubjectFieldRepository $subjectFieldRepository,
        readonly protected TemplateRenderingService $templateRenderingService,
    ) {
    }

    public function initializeListAction(): void
    {
        $this->initializeControllerAction();
    }

    /**
     * @param array<string, mixed> $search
     * @throws InvalidQueryException
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
     * but if the customer changes office back to "" an empty __identity was send
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
        if ($office instanceof Office || $search !== '') {
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
        $this->addFlashMessage(
            LocalizationUtility::translate('employeeCreated', ExtConf::EXT_KEY)
        );

        return $this->redirect('list');
    }

    public function initializeEditAction(): void
    {
        $this->initializeControllerAction();
    }

    public function editAction(Employee $employee): ResponseInterface
    {
        if (!$employee->getIsCatchAllMail()) {
            $hash = (string)$this->request->getArgument('hash');

            if ($this->hashService->validateHmac(
                'Employee:' . $employee->getUid(),
                $this->extConf->getAdditionalSecretForHashGeneration(),
                $hash
            )) {
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
        if ($this->request->hasArgument('employee')) {
            $employeeMappingConfiguration = $this->arguments
                ->getArgument('employee')
                ->getPropertyMappingConfiguration();

            $this->propertyMappingConfigurator
                ->configureEmployeeMapping($employeeMappingConfiguration);

            $persistedEmployee = $this->employeeRepository->findByIdentifier(
                $this
                    ->request
                    ->getArgument('employee')['__identity'],
            );

            if ($persistedEmployee instanceof Employee) {
                $this
                    ->assignMediaTypeConverter(
                        'image',
                        $employeeMappingConfiguration,
                        $persistedEmployee->getImage(),
                        $this->settings,
                    );
            }
        }

        $this->initializeControllerAction();
    }

    public function updateAction(Employee $employee): ResponseInterface
    {
        $this->employeeRepository->update($employee);
        $this->addFlashMessage(LocalizationUtility::translate('employeeUpdated', ExtConf::EXT_KEY));

        return $this->redirectToEmployee(
            'show',
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
            $this->templateRenderingService
                ->sendEmployeeEditMail(
                    $employee,
                    $this->request,
                    $this->settings
                );
            $this->addFlashMessage(LocalizationUtility::translate('emailWasSend', ExtConf::EXT_KEY));
        } catch (\Exception $exception) {
            $this->logger->error('Failed to send employee edit email', [
                'employeeUid' => $employee->getUid(),
                'exceptionCode' => $exception->getCode(),
                'message' => $exception->getMessage(),
                'trace' => $exception->getTraceAsString()
            ]);

            $this->addFlashMessage(
                LocalizationUtility::translate('email.error', ExtConf::EXT_KEY),
                'Error',
            );
        }

        return $this->redirectToEmployee(
            'show',
            ['employee' => $employee],
        );
    }
}
