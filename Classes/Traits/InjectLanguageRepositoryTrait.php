<?php

declare(strict_types=1);

/*
 * This file is part of the package jweiland/telephonedirectory.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace JWeiland\Telephonedirectory\Traits;

use JWeiland\Telephonedirectory\Domain\Repository\LanguageRepository;

trait InjectLanguageRepositoryTrait
{
    protected LanguageRepository $languageRepository;

    public function injectLanguageRepository(LanguageRepository $languageRepository): void
    {
        $this->languageRepository = $languageRepository;
    }
}
