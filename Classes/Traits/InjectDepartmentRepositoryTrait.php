<?php

declare(strict_types=1);

/*
 * This file is part of the package jweiland/telephonedirectory.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace JWeiland\Telephonedirectory\Traits;

use JWeiland\Telephonedirectory\Domain\Repository\DepartmentRepository;

trait InjectDepartmentRepositoryTrait
{
    protected DepartmentRepository $departmentRepository;

    public function injectDepartmentRepository(DepartmentRepository $departmentRepository): void
    {
        $this->departmentRepository = $departmentRepository;
    }
}
