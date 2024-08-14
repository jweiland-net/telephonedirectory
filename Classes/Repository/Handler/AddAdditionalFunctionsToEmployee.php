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
 * Apply additional function records to employee
 * The additional functions are realized with TYPO3s sys_category
 */
class AddAdditionalFunctionsToEmployee implements ApplyRecordToEmployeeInterface
{
    use GetQueryBuilderForTableTrait;
    use LowerCamelCaseArrayKeysTrait;

    private const COLUMN = 'additional_function';

    private const PROPERTY = 'additionalFunction';

    private const TABLE_NAME = 'tx_telephonedirectory_domain_model_employee';

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

        $employee[self::PROPERTY] = $this->getAdditionalFunctionRecords((int)$employee['uid']);
    }

    private function getAdditionalFunctionRecords(int $employeeUid): array
    {
        $queryBuilder = $this->getQueryBuilderForTable('sys_category');
        try {
            $queryResult = $queryBuilder
                ->select('*')
                ->from('sys_category', 'sc')
                ->leftJoin(
                    'sc',
                    'sys_category_record_mm',
                    'sc_mm',
                    (string)$queryBuilder->expr()->and(
                        $queryBuilder->expr()->eq(
                            'sc_mm.tablenames',
                            $queryBuilder->createNamedParameter(self::TABLE_NAME),
                        ),
                        $queryBuilder->expr()->eq(
                            'sc_mm.fieldname',
                            $queryBuilder->createNamedParameter(self::COLUMN),
                        ),
                        $queryBuilder->expr()->eq(
                            'sc_mm.uid_local',
                            $queryBuilder->quoteIdentifier('sc.uid'),
                        ),
                    ),
                )
                ->where(
                    $queryBuilder->expr()->eq(
                        'sc_mm.uid_foreign',
                        $queryBuilder->createNamedParameter($employeeUid, \PDO::PARAM_INT),
                    ),
                )
                ->groupBy('sc.uid')
                ->execute();

            $additionalFunctions = [];
            while ($additionalFunction = $queryResult->fetchAssociative()) {
                $additionalFunctions[$additionalFunction['uid']] = $this->lowerCamelCaseArrayKeys($additionalFunction);
            }
            return $additionalFunctions;
        } catch (Exception $e) {
        }

        return [];
    }
}
