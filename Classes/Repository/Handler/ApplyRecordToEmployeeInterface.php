<?php

declare(strict_types=1);

/*
 * This file is part of the package jweiland/telephonedirectory.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace JWeiland\Telephonedirectory\Repository\Handler;

/**
 * The employee has multiple sub-properties which has to be filled.
 * Register a class implementing from this interface will add further records to employee array
 */
interface ApplyRecordToEmployeeInterface
{
    /**
     * This is the main entrypoint to add further records to the employee array
     *
     * @param array<string, mixed> $employee
     */
    public function applyTo(array &$employee): void;
}
