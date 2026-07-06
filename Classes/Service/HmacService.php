<?php

declare(strict_types=1);

/*
 * This file is part of the package jweiland/telephonedirectory.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace JWeiland\Telephonedirectory\Service;

use JWeiland\Telephonedirectory\Configuration\ExtConf;
use TYPO3\CMS\Core\Crypto\HashService;

readonly class HmacService
{
    public function __construct(
        private HashService $hashService,
        private ExtConf $extConf,
    ) {}

    public function getHmacForEmployee(int $uid): string
    {
        return $this->hashService->hmac(
            'Employee:' . $uid,
            $this->extConf->getAdditionalSecretForHashGeneration(),
        );
    }
}
