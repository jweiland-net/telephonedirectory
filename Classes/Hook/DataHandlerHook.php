<?php

declare(strict_types=1);

/*
 * This file is part of the package jweiland/telephonedirectory.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace JWeiland\Telephonedirectory\Hook;

use JWeiland\Telephonedirectory\Service\HmacService;
use TYPO3\CMS\Backend\Utility\BackendUtility;
use TYPO3\CMS\Core\Database\Connection;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\DataHandling\DataHandler;

/**
 * Adds a secret to the employee record on INSERT and on UPDATE when the secret column is empty.
 */
readonly class DataHandlerHook
{
    private const TABLE = 'tx_telephonedirectory_domain_model_employee';

    public function __construct(
        private HmacService $hmacService,
        private ConnectionPool $connectionPool,
    ) {}

    public function processDatamap_afterDatabaseOperations(
        string $status,
        string $table,
        int|string $id,
        array $fieldArray,
        DataHandler $dataHandler,
    ): void {
        if ($table !== self::TABLE) {
            return;
        }

        $employeeUid = $this->getRealEmployeeUid($id, $dataHandler);

        if ($employeeUid === 0) {
            return;
        }

        $employeeRecord = BackendUtility::getRecord(
            self::TABLE,
            $employeeUid,
            'uid, secret',
            ' AND secret = \'\'',
        );

        if ($employeeRecord === null || $employeeRecord === []) {
            return;
        }

        $connection = $this->connectionPool->getConnectionForTable(self::TABLE);
        $connection->update(
            self::TABLE,
            [
                'secret' => $this->hmacService->getHmacForEmployee((int)$employeeRecord['uid']),
            ],
            [
                'uid' => $employeeUid,
            ],
            [
                'secret' => Connection::PARAM_STR,
            ],
        );
    }

    private function getRealEmployeeUid(int|string $newOrUid, DataHandler $dataHandler): int
    {
        if (str_starts_with((string)$newOrUid, 'NEW')) {
            $realUid = (int)($dataHandler->substNEWwithIDs[$newOrUid] ?? 0);
        } else {
            $realUid = (int)$newOrUid;
        }

        return $realUid;
    }
}
