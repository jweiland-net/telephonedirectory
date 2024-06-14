<?php

declare(strict_types=1);

/*
 * This file is part of the package jweiland/telephonedirectory.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace JWeiland\Telephonedirectory\Event;

use JWeiland\Telephonedirectory\Controller\EmployeeController;
use JWeiland\Telephonedirectory\Controller\InterpreterController;
use JWeiland\Telephonedirectory\Domain\Model\Employee;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Extbase\Mvc\Request;

/**
 * Pre process controller actions which does not assign any variables to view.
 * Often used by controller actions like "update" or "create" which redirects after success.
 */
class PreProcessControllerActionEvent implements ControllerActionEventInterface
{
    protected EmployeeController|ActionController|InterpreterController $controller;

    protected ?Employee $employee;

    protected array $settings;

    protected Request $request;

    public function __construct(
        ActionController $controller,
        ?Employee $employee,
        array $settings,
        Request $request
    ) {
        $this->controller = $controller;
        $this->employee = $employee;
        $this->settings = $settings;
        $this->request = $request;
    }

    public function getController(): ActionController
    {
        return $this->controller;
    }

    public function getEmployeeController(): EmployeeController
    {
        return $this->controller;
    }

    public function getInterpretterController(): InterpreterController
    {
        return $this->controller;
    }

    public function getRequest(): Request
    {
        return $this->request;
    }

    public function getControllerName(): string
    {
        return $this->getRequest()->getControllerName();
    }

    public function getActionName(): string
    {
        return $this->getRequest()->getControllerActionName();
    }

    public function getEmployee(): ?Employee
    {
        return $this->employee;
    }

    public function getSettings(): array
    {
        return $this->settings;
    }
}
