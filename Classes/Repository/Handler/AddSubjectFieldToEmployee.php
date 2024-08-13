<?php

declare(strict_types=1);

/*
 * This file is part of the package jweiland/telephonedirectory.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace JWeiland\Telephonedirectory\Repository\Handler;

use Doctrine\DBAL\DBALException;
use Doctrine\DBAL\Driver\Exception;
use JWeiland\Telephonedirectory\Traits\GetQueryBuilderForTableTrait;
use JWeiland\Telephonedirectory\Traits\LowerCamelCaseArrayKeysTrait;
use TYPO3\CMS\Core\Utility\MathUtility;

/**
 * Apply subject field record to employee
 */
class AddSubjectFieldToEmployee implements ApplyRecordToEmployeeInterface
{
    use GetQueryBuilderForTableTrait;
    use LowerCamelCaseArrayKeysTrait;

    private const PROPERTY = 'subjectField';

    private const TABLE_NAME = 'tx_telephonedirectory_domain_model_subjectfield';

    public function applyTo(array &$employee): void
    {
        if (!array_key_exists(self::PROPERTY, $employee)) {
            $employee[self::PROPERTY] = [];
            return;
        }

        if (!MathUtility::canBeInterpretedAsInteger($employee[self::PROPERTY])) {
            $employee[self::PROPERTY] = [];
            return;
        }

        $employee[self::PROPERTY] = $this->getSubjectFieldRecord((int)$employee[self::PROPERTY]);
    }

    private function getSubjectFieldRecord(int $subjectFieldUid): array
    {
        $queryBuilder = $this->getQueryBuilderForTable(self::TABLE_NAME);
        try {
            $subjectFieldRecord = $queryBuilder
                ->select('*')
                ->from(self::TABLE_NAME)
                ->where(
                    $queryBuilder->expr()->eq(
                        'uid',
                        $queryBuilder->createNamedParameter($subjectFieldUid, \PDO::PARAM_INT),
                    ),
                )
                ->execute()
                ->fetchAssociative();
            return is_array($subjectFieldRecord) ? $this->lowerCamelCaseArrayKeys($subjectFieldRecord) : [];
        } catch (DBALException | Exception $e) {
        }

        return [];
    }
}
