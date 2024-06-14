<?php

declare(strict_types=1);

/*
 * This file is part of the package jweiland/telephonedirectory.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace JWeiland\Telephonedirectory\Traits;

use JWeiland\Telephonedirectory\Event\InitializeControllerActionEvent;
use Psr\EventDispatcher\EventDispatcherInterface;
use TYPO3\CMS\Extbase\Mvc\Controller\Arguments;
use TYPO3\CMS\Extbase\Mvc\RequestInterface;

trait InitializeControllerActionTrait
{
    protected function emitInitializeControllerAction(
        EventDispatcherInterface $eventDispatcher,
        RequestInterface $request,
        Arguments $arguments,
        array $settings
    ): void
    {
        $eventDispatcher->dispatch(
            new InitializeControllerActionEvent(
                $request,
                $arguments,
                $settings
            )
        );
    }
}
