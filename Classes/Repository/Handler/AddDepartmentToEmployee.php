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
 * Apply department record to employee
 */
class AddDepartmentToEmployee implements ApplyRecordToEmployeeInterface
{
    use GetQueryBuilderForTableTrait;
    use LowerCamelCaseArrayKeysTrait;

    private const PROPERTY = 'department';

    private const TABLE_NAME = 'tx_telephonedirectory_domain_model_department';

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

        $employee[self::PROPERTY] = $this->getDepartmentRecord((int)$employee[self::PROPERTY]);
    }

    /**
     * @return array<string, mixed>
     */
    private function getDepartmentRecord(int $departmentUid): array
    {
        $queryBuilder = $this->getQueryBuilderForTable(self::TABLE_NAME);
        try {
            $departmentRecord = $queryBuilder
                ->select('*')
                ->from(self::TABLE_NAME)
                ->where(
                    $queryBuilder->expr()->eq(
                        'uid',
                        $queryBuilder->createNamedParameter($departmentUid, Connection::PARAM_INT),
                    ),
                )
                ->executeQuery()
                ->fetchAssociative();
            return is_array($departmentRecord) ? $this->lowerCamelCaseArrayKeys($departmentRecord) : [];
        } catch (\Doctrine\DBAL\Exception $e) {
        }

        return [];
    }
}
