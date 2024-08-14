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
use JWeiland\Telephonedirectory\Event\PostProcessFluidVariablesEvent;
use JWeiland\Telephonedirectory\Event\PreProcessControllerActionEvent;
use JWeiland\Telephonedirectory\Traits\InitializeControllerActionTrait;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

class AbstractController extends ActionController
{
    use InitializeControllerActionTrait;

    /**
     * @param array<string, mixed> $variables
     */
    protected function postProcessAndAssignFluidVariables(array $variables = []): void
    {
        /** @var PostProcessFluidVariablesEvent $event */
        $event = $this->eventDispatcher->dispatch(
            new PostProcessFluidVariablesEvent(
                $this->request,
                $this->settings,
                $variables,
            ),
        );

        $this->view->assignMultiple($event->getFluidVariables());
    }

    protected function preProcessControllerAction(?Employee $employee = null): void
    {
        $this->eventDispatcher->dispatch(
            new PreProcessControllerActionEvent(
                $this,
                $employee,
                $this->settings,
                $this->request,
            ),
        );
    }
}
