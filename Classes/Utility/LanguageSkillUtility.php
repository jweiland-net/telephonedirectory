<?php

declare(strict_types=1);

/*
 * This file is part of the package jweiland/telephonedirectory.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace JWeiland\Telephonedirectory\Utility;

use TYPO3\CMS\Extbase\Utility\LocalizationUtility;

/**
 * Class LanguageSkillUtility
 */
class LanguageSkillUtility
{
    /**
     * @var array
     */
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

    /**
     * @var array
     */
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
