<?php

declare(strict_types=1);

/*
 * This file is part of the package jweiland/telephonedirectory.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace JWeiland\Telephonedirectory\Event;

use TYPO3\CMS\Extbase\Mvc\Controller\Arguments;
use TYPO3\CMS\Extbase\Mvc\RequestInterface;

/**
 * An event used within various initialize controller actions
 */
class InitializeControllerActionEvent implements ControllerActionEventInterface
{
    protected RequestInterface $request;

    protected Arguments $arguments;

    /**
     * @var array<string, mixed>
     */
    protected array $settings = [];

    /**
     * @param array<string, mixed> $settings
     */
    public function __construct(RequestInterface $request, Arguments $arguments, array $settings)
    {
        $this->request = $request;
        $this->arguments = $arguments;
        $this->settings = $settings;
    }

    public function getRequest(): RequestInterface
    {
        return $this->request;
    }

    public function getControllerName(): string
    {
        return $this->request->getControllerName();
    }

    public function getActionName(): string
    {
        return $this->request->getControllerActionName();
    }

    public function getArguments(): Arguments
    {
        return $this->arguments;
    }

    /**
     * @return  array<string, mixed>
     */
    public function getSettings(): array
    {
        return $this->settings;
    }
}
