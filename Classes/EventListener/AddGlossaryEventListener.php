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
    protected const ALLOWED_CONTROLLER_ACTIONS = [
        'Employee' => [
            'list',
            'search',
        ],
    ];

    public function __construct(
        protected GlossaryService $glossaryService,
        protected EmployeeRepository $employeeRepository,
    ) {}

    public function __invoke(PostProcessFluidVariablesEvent $event): void
    {
        if ($this->isValidRequest($event)) {
            $event->addFluidVariable(
                'glossary',
                $this->glossaryService->buildGlossary(
                    $this->employeeRepository->getQueryBuilderToFindAllEntries(),
                    $this->getOptions($event),
                    $event->getRequest(),
                ),
            );
        }
    }

    /**
     * @return array<int, mixed>
     */
    protected function getOptions(PostProcessFluidVariablesEvent $event): array
    {
        $options = [
            'extensionName' => 'telephonedirectory',
            'pluginName' => 'telephone',
            'controllerName' => 'Employee',
            'column' => 'last_name',
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
