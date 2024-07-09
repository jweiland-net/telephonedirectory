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

    public function initializeAction(): void
    {
        // if this value was not set, then it will be filled with 0
        // but that is not good, because UriBuilder accepts 0 as pid,
        // so it's better to set it to null
        if (empty($this->settings['pidOfDetailPage'])) {
            $this->settings['pidOfDetailPage'] = null;
        }
    }

    protected function postProcessAndAssignFluidVariables(array $variables = []): void
    {
        /** @var PostProcessFluidVariablesEvent $event */
        $event = $this->eventDispatcher->dispatch(
            new PostProcessFluidVariablesEvent(
                $this->request,
                $this->settings,
                $variables
            )
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
                $this->request
            )
        );
    }
}
