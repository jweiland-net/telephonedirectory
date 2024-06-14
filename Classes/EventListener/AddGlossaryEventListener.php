<?php

declare(strict_types=1);

/*
 * This file is part of the package jweiland/telephonedirectory.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace JWeiland\Telephonedirectory\EventListener;

use JWeiland\Glossary2\Service\GlossaryService;
use JWeiland\Telephonedirectory\Domain\Repository\EmployeeRepository;
use JWeiland\Telephonedirectory\Event\PostProcessFluidVariablesEvent;
use TYPO3\CMS\Core\Utility\ArrayUtility;

class AddGlossaryEventListener extends AbstractControllerEventListener
{
    protected GlossaryService $glossaryService;

    protected EmployeeRepository $employeeRepository;

    protected array $allowedControllerActions = [
        'Employee' => [
            'list',
            'search',
        ],
    ];

    public function __construct(GlossaryService $glossaryService, EmployeeRepository $employeeRepository)
    {
        $this->glossaryService = $glossaryService;
        $this->employeeRepository = $employeeRepository;
    }

    public function __invoke(PostProcessFluidVariablesEvent $event): void
    {
        if ($this->isValidRequest($event)) {
            $event->addFluidVariable(
                'glossary',
                $this->glossaryService->buildGlossary(
                    $this->employeeRepository->getQueryBuilderToFindAllEntries(),
                    $this->getOptions($event),
                    $event->getRequest()
                )
            );
        }
    }

    protected function getOptions(PostProcessFluidVariablesEvent $event): array
    {
        $options = [
            'extensionName' => 'telephonedirectory',
            'pluginName' => 'telephone',
            'controllerName' => 'Employee',
            'column' => 'title',
            'settings' => $event->getSettings(),
        ];

        if (
            isset($event->getSettings()['glossary'])
            && is_array($event->getSettings()['glossary'])
        ) {
            ArrayUtility::mergeRecursiveWithOverrule($options, $event->getSettings()['glossary']);
        }

        return $options;
    }
}
