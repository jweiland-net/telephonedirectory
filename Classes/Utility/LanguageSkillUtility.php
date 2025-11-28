<?php

declare(strict_types=1);

/*
 * This file is part of the package jweiland/telephonedirectory.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace JWeiland\Telephonedirectory\Utility;
yma
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;

class LanguageSkillUtility
{
    /**
     * @var array<int, array{string, string}>
     */
    protected static array $languageSkills = [
        [
            'label' => 'LLL:EXT:telephonedirectory/Resources/Private/Language/locallang_db.xlf:tx_telephonedirectory_domain_model_languageskill.skill.none',
            'value' => '0',
        ],
        [
            'label' => 'LLL:EXT:telephonedirectory/Resources/Private/Language/locallang_db.xlf:tx_telephonedirectory_domain_model_languageskill.skill.native',
            'value' => 'native',
        ],
        [
            'label' => 'LLL:EXT:telephonedirectory/Resources/Private/Language/locallang_db.xlf:tx_telephonedirectory_domain_model_languageskill.skill.fluent',
            'value' => 'fluent',
        ],
        [
            'label' => 'LLL:EXT:telephonedirectory/Resources/Private/Language/locallang_db.xlf:tx_telephonedirectory_domain_model_languageskill.skill.good',
            'value' => 'good',
        ],
        [
            'label' => 'LLL:EXT:telephonedirectory/Resources/Private/Language/locallang_db.xlf:tx_telephonedirectory_domain_model_languageskill.skill.basic',
            'value' => 'basic',
        ],
    ];

    /**
     * @var array<int, array{string, string}>
     */
    protected static array $languageSkillsForFluidSelect = [];

    /**
     * Returns an array of language skills.
     *
     * @return array<int, array{string, string}>
     */
    public static function getLanguageSkills(): array
    {
        return self::$languageSkills;
    }

    /**
     * Returns an array of language skills for fluid select fields.
     *
     * @return array<int, array{string, string}>
     */
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
