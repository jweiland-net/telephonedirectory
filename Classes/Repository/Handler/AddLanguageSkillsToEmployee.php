<?php

declare(strict_types=1);

/*
 * This file is part of the package jweiland/telephonedirectory.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace JWeiland\Telephonedirectory\Repository\Handler;

use JWeiland\Telephonedirectory\Traits\GetQueryBuilderForTableTrait;
use JWeiland\Telephonedirectory\Traits\LowerCamelCaseArrayKeysTrait;
use TYPO3\CMS\Core\Database\Connection;
use TYPO3\CMS\Core\Utility\MathUtility;

/**
 * Apply language skill records to employee
 */
class AddLanguageSkillsToEmployee implements ApplyRecordToEmployeeInterface
{
    use GetQueryBuilderForTableTrait;
    use LowerCamelCaseArrayKeysTrait;

    private const PROPERTY = 'languageSkill';

    private const TABLE_NAME = 'tx_telephonedirectory_domain_model_languageskill';

    public function applyTo(array &$employee): void
    {
        if (!array_key_exists('uid', $employee)) {
            $employee[self::PROPERTY] = [];
            return;
        }

        if (!MathUtility::canBeInterpretedAsInteger($employee['uid'])) {
            $employee[self::PROPERTY] = [];
            return;
        }

        $employee[self::PROPERTY] = $this->getLanguageSkillRecords((int)$employee['uid']);
    }

    /**
     * @return array<string, mixed>
     */
    private function getLanguageSkillRecords(int $employeeUid): array
    {
        $queryBuilder = $this->getQueryBuilderForTable(self::TABLE_NAME);
        try {
            $queryResult = $queryBuilder
                ->select('*')
                ->from(self::TABLE_NAME)
                ->where(
                    $queryBuilder->expr()->eq(
                        'employee',
                        $queryBuilder->createNamedParameter($employeeUid, Connection::PARAM_INT),
                    ),
                )
                ->executeQuery();

            $languageSkills = [];
            while ($languageSkill = $queryResult->fetchAssociative()) {
                $languageSkill['language'] = $this->getLanguageRecord($languageSkill['language']);
                $languageSkills[$languageSkill['uid']] = $this->lowerCamelCaseArrayKeys($languageSkill);
            }
            return $languageSkills;
        } catch (\Doctrine\DBAL\Exception $e) {
        }

        return [];
    }

    /**
     * @return array<string, mixed>
     */
    private function getLanguageRecord(int $languageUid): array
    {
        $queryBuilder = $this->getQueryBuilderForTable('tx_telephonedirectory_domain_model_language');
        try {
            $languageRecord = $queryBuilder
                ->select('*')
                ->from('tx_telephonedirectory_domain_model_language')
                ->where(
                    $queryBuilder->expr()->eq(
                        'uid',
                        $queryBuilder->createNamedParameter($languageUid, Connection::PARAM_INT),
                    ),
                )
                ->executeQuery()
                ->fetchAssociative();
            return is_array($languageRecord) ? $this->lowerCamelCaseArrayKeys($languageRecord) : [];
        } catch (\Doctrine\DBAL\Exception $e) {
        }

        return [];
    }
}
