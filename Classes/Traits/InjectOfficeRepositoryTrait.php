<?php

declare(strict_types=1);

/*
 * This file is part of the package jweiland/telephonedirectory.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace JWeiland\Telephonedirectory\Traits;

use JWeiland\Telephonedirectory\Domain\Repository\OfficeRepository;

trait InjectOfficeRepositoryTrait
{
    protected OfficeRepository $officeRepository;

    public function injectOfficeRepository(OfficeRepository $officeRepository): void
    {
        $this->officeRepository = $officeRepository;
    }
}
