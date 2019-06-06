<?php
declare(strict_types=1);
namespace JWeiland\Telephonedirectory\Utility;

/*
 * This file is part of the telephonedirectory project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

use In2code\Powermail\Utility\LocalizationUtility;

/**
 * Class LanguageSkillUtility
 */
class LanguageSkillUtility
{
    protected static $languageSkills = [
        [
            'LLL:EXT:telephonedirectory/Resources/Private/Language/locallang_db.xlf:tx_telephonedirectory_domain_model_languageskill.skill.none',
            '0'
        ],
        [
            'LLL:EXT:telephonedirectory/Resources/Private/Language/locallang_db.xlf:tx_telephonedirectory_domain_model_languageskill.skill.native',
            'native'
        ],
        [
            'LLL:EXT:telephonedirectory/Resources/Private/Language/locallang_db.xlf:tx_telephonedirectory_domain_model_languageskill.skill.fluent',
            'fluent'
        ],
        [
            'LLL:EXT:telephonedirectory/Resources/Private/Language/locallang_db.xlf:tx_telephonedirectory_domain_model_languageskill.skill.good',
            'good'
        ],
        [
            'LLL:EXT:telephonedirectory/Resources/Private/Language/locallang_db.xlf:tx_telephonedirectory_domain_model_languageskill.skill.basic',
            'basic'
        ]
    ];

    protected static $languageSkillsForFluidSelect = [];

    public static function getLanguageSkills(): array
    {
        return self::$languageSkills;
    }

    public static function getLanguageSkillsForFluidSelect(): array
    {
        if (!self::$languageSkillsForFluidSelect) {
            foreach (self::getLanguageSkills() as $skill) {
                self::$languageSkillsForFluidSelect[$skill[1]] = LocalizationUtility::translate($skill[0]);
            }
        }

        return self::$languageSkillsForFluidSelect;
    }
}
