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

/**
 * Abstract EventListener just for action controllers.
 */
class AbstractControllerEventListener
{
    /**
     * Only execute this EventListener, if controller and action matches
     *
     * @var array<string, array<int, string>>
     */
    protected const ALLOWED_CONTROLLER_ACTIONS = [];

    protected function isValidRequest(ControllerActionEventInterface $event): bool
    {
        $allowedControllerActions = $this->getAllowedControllerActions();

        return
            array_key_exists(
                $event->getControllerName(),
                $allowedControllerActions,
            )
            && in_array(
                $event->getActionName(),
                $allowedControllerActions[$event->getControllerName()],
                true,
            );
    }

    /**
     * @return array<string, array<int, string>>
     */
    protected function getAllowedControllerActions(): array
    {
        return self::ALLOWED_CONTROLLER_ACTIONS;
    }
}
