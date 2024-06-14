<?php

declare(strict_types=1);

/*
 * This file is part of the package jweiland/telephonedirectory.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace JWeiland\Telephonedirectory\Traits;

use TYPO3\CMS\Extbase\Security\Cryptography\HashService;

trait InjectHashServiceTrait
{
    protected HashService $hashService;

    public function injectHashService(HashService $hashService): void
    {
        $this->hashService = $hashService;
    }
}
