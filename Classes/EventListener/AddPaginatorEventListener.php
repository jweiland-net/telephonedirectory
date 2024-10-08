<?php

declare(strict_types=1);

/*
 * This file is part of the package jweiland/telephonedirectory.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace JWeiland\Telephonedirectory\EventListener;

use JWeiland\Telephonedirectory\Event\ControllerActionEventInterface;
use JWeiland\Telephonedirectory\Event\PostProcessFluidVariablesEvent;
use JWeiland\Telephonedirectory\Pagination\RecordPagination;
use TYPO3\CMS\Extbase\Pagination\QueryResultPaginator;

class AddPaginatorEventListener
{
    protected int $itemsPerPage = 15;

    protected const ALLOWED_CONTROLLER_ACTIONS = [
        'Employee' => [
            'list',
            'search',
            'show',
            'new',
            'create',
            'edit',
            'update',
            'sendEditMail',
        ],
        'InterpreterController' => [
            'list',
        ],
    ];

    public function __invoke(PostProcessFluidVariablesEvent $event): void
    {
        if ($this->isValidRequest($event)) {
            $paginator = new QueryResultPaginator(
                $event->getFluidVariables()['employees'],
                $this->getCurrentPage($event),
                $this->getItemsPerPage($event),
            );

            $event->addFluidVariable('actionName', $event->getActionName());
            $event->addFluidVariable('paginator', $paginator);
            $event->addFluidVariable('employees', $paginator->getPaginatedItems());
            $event->addFluidVariable('pagination', new RecordPagination($paginator));
        }
    }

    protected function getCurrentPage(PostProcessFluidVariablesEvent $event): int
    {
        $currentPage = 1;
        if ($event->getRequest()->hasArgument('currentPage')) {
            $currentPage = $event->getRequest()->getArgument('currentPage');
        }

        return (int)$currentPage;
    }

    protected function getItemsPerPage(PostProcessFluidVariablesEvent $event): int
    {
        $itemsPerPage = $this->itemsPerPage;
        if (isset($event->getSettings()['pageBrowser']['itemsPerPage'])) {
            $itemsPerPage = $event->getSettings()['pageBrowser']['itemsPerPage'];
        }

        return (int)$itemsPerPage;
    }

    protected function isValidRequest(ControllerActionEventInterface $event): bool
    {
        return
            array_key_exists(
                $event->getControllerName(),
                self::ALLOWED_CONTROLLER_ACTIONS,
            )
            && in_array(
                $event->getActionName(),
                self::ALLOWED_CONTROLLER_ACTIONS[$event->getControllerName()],
                true,
            );
    }
}
