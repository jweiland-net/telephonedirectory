<?php

declare(strict_types=1);

/*
 * This file is part of the package jweiland/telephonedirectory.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace JWeiland\Telephonedirectory\Repository;

use JWeiland\Telephonedirectory\Repository\Handler\ApplyRecordToEmployeeInterface;
use JWeiland\Telephonedirectory\Traits\GetQueryBuilderForTableTrait;
use JWeiland\Telephonedirectory\Traits\LowerCamelCaseArrayKeysTrait;
use TYPO3\CMS\Core\Database\Connection;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Build an employee array with all its properties and sub-properties
 * This factory will be used in a scheduler task where we don't have any extbase context.
 * To prevent side effects with extbase objects in a non extbase context this repository returns just arrays.
 * To be as compatible with domain model properties we apply lowerCamelCase to all property keys.
 */
class EmployeeFactory
{
    use GetQueryBuilderForTableTrait;
    use LowerCamelCaseArrayKeysTrait;

    private const TABLE_NAME = 'tx_telephonedirectory_domain_model_employee';

    /**
     * @var iterable<ApplyRecordToEmployeeInterface>
     */
    private iterable $handlers;

    /**
     * @param iterable<ApplyRecordToEmployeeInterface> $handlers
     */
    public function __construct(iterable $handlers)
    {
        $this->handlers = $handlers;
    }

    /**
     * @return array<string, mixed>
     */
    public function build(int $employeeUid): array
    {
        $employee = $this->getEmployee($employeeUid);

        foreach ($this->handlers as $handler) {
            if ($handler instanceof ApplyRecordToEmployeeInterface) {
                $handler->applyTo($employee);
            }
        }

        return $employee;
    }

    /**
     * @return array<string, mixed>
     */
    public function getEmployee(int $employeeUid): array
    {
        $queryBuilder = $this->getQueryBuilderForTable(self::TABLE_NAME);
        try {
            $employee = $queryBuilder
                ->select('*')
                ->from(self::TABLE_NAME)
                ->where(
                    $queryBuilder->expr()->eq(
                        'uid',
                        $queryBuilder->createNamedParameter($employeeUid, Connection::PARAM_INT),
                    ),
                )
                ->executeQuery()
                ->fetchAssociative();
            return $this->lowerCamelCaseArrayKeys($employee);
        } catch (\Doctrine\DBAL\Exception $e) {
        }

        return [];
    }

    /**
     * @return array<string, mixed>
     */
    public function getEmployees(string $csvStorages, bool $onlyUid = false): array
    {
        $storages = GeneralUtility::intExplode(',', $csvStorages, true);

        $queryBuilder = $this->getQueryBuilderForTable(self::TABLE_NAME);
        try {
            $queryResult = $queryBuilder
                ->select($onlyUid ? 'uid' : '*')
                ->from(self::TABLE_NAME)
                ->where(
                    $queryBuilder->expr()->in(
                        'pid',
                        $queryBuilder->createNamedParameter($storages, Connection::PARAM_INT_ARRAY),
                    ),
                )
                ->executeQuery();

            $employees = [];
            while ($employee = $queryResult->fetchAssociative()) {
                $employees[$employee['uid']] = $onlyUid ? $employee['uid'] : $this->lowerCamelCaseArrayKeys($employee);
            }
            return $employees;
        } catch (\Doctrine\DBAL\Exception $e) {
        }

        return [];
    }
}
