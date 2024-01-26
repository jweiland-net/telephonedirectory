<?php

declare(strict_types=1);

/*
 * This file is part of the package jweiland/telephonedirectory.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace JWeiland\Telephonedirectory\Traits;

use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Trait to lowerCamelCase all array keys
 */
trait LowerCamelCaseArrayKeysTrait
{
    public function lowerCamelCaseArrayKeys(array $arrayWithUnderscoredKeys): array
    {
        $arrayWithLowerCamelCaseKeys = [];
        foreach ($arrayWithUnderscoredKeys as $underscoredKey => $value) {
            $lowerCamelCaseKey = GeneralUtility::underscoredToLowerCamelCase($underscoredKey);
            $arrayWithLowerCamelCaseKeys[$lowerCamelCaseKey] = $value;
        }

        return $arrayWithLowerCamelCaseKeys;
    }
}
