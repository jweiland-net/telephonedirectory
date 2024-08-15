<?php

declare(strict_types=1);

/*
 * This file is part of the package jweiland/telephonedirectory.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace JWeiland\Telephonedirectory\Event;

use TYPO3\CMS\Extbase\Mvc\RequestInterface;

interface ControllerActionEventInterface
{
    public function getRequest(): RequestInterface;

    public function getControllerName(): string;

    public function getActionName(): string;

    /**
     * @return array<string, mixed>
     */
    public function getSettings(): array;
}
