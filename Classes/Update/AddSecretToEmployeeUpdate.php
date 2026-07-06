<?php

declare(strict_types=1);

/*
 * This file is part of the package jweiland/telephonedirectory.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace JWeiland\Telephonedirectory\Update;

use Doctrine\DBAL\Exception;
use JWeiland\Telephonedirectory\Service\HmacService;
use Psr\Log\LoggerInterface;
use TYPO3\CMS\Core\Database\Connection;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Database\Query\QueryBuilder;
use TYPO3\CMS\Install\Attribute\UpgradeWizard;
use TYPO3\CMS\Install\Updates\DatabaseUpdatedPrerequisite;
use TYPO3\CMS\Install\Updates\UpgradeWizardInterface;

#[UpgradeWizard(
    identifier: 'telephonedirectory_addEmployeeSecret',
)]
class AddSecretToEmployeeUpdate implements UpgradeWizardInterface
{
    private const TABLE = 'tx_telephonedirectory_domain_model_employee';

    public function __construct(
        private readonly ConnectionPool $connectionPool,
        private readonly HmacService $hmacService,
        private readonly LoggerInterface $logger,
    ) {}

    public function getTitle(): string
    {
        return '[telephonedirectory] Add secret to employees';
    }

    public function getDescription(): string
    {
        return 'Adds missing secrets to employees. Hidden and deleted records are included as well, because they can become valid records again at any time in the recycler.';
    }

    public function updateNecessary(): bool
    {
        $queryBuilder = $this->getQueryBuilder();

        try {
            $numberOfEmployeesWithoutSecret = $queryBuilder
                ->count('*')
                ->from(self::TABLE)
                ->where(
                    $queryBuilder->expr()->eq(
                        'secret',
                        $queryBuilder->createNamedParameter(''),
                    ),
                )
                ->executeQuery()
                ->fetchOne();
        } catch (Exception $e) {
            $this->logger->error(
                sprintf(
                    'Failed to count employees without secret: %s in %s:%d',
                    $e->getMessage(),
                    $e->getFile(),
                    $e->getLine()
                )
            );
            return true;
        }

        return (bool)$numberOfEmployeesWithoutSecret;
    }

    public function executeUpdate(): bool
    {
        foreach ($this->getEmployeesWithoutSecret() as $employeeWithoutSecret) {
            $connection = $this->connectionPool->getConnectionForTable(self::TABLE);
            $connection->update(
                self::TABLE,
                [
                    'secret' => $this->hmacService->getHmacForEmployee((int)$employeeWithoutSecret['uid']),
                ],
                [
                    'uid' => (int)$employeeWithoutSecret['uid'],
                ],
                [
                    'secret' => Connection::PARAM_STR,
                ],
            );
        }

        return true;
    }

    private function getEmployeesWithoutSecret(): array
    {
        $queryBuilder = $this->getQueryBuilder();

        try {
            $employeesWithoutSecret = $queryBuilder
                ->select('uid')
                ->from(self::TABLE)
                ->where(
                    $queryBuilder->expr()->eq(
                        'secret',
                        $queryBuilder->createNamedParameter(''),
                    ),
                )
                ->executeQuery()
                ->fetchAllAssociative();
        } catch (Exception $e) {
            $this->logger->error(
                sprintf(
                    'Failed to fetch employees without secret: %s in %s:%d',
                    $e->getMessage(),
                    $e->getFile(),
                    $e->getLine()
                )
            );
            $employeesWithoutSecret = [];
        }

        return $employeesWithoutSecret;
    }

    /**
     * Returns a query builder for the employee table with all restrictions removed.
     *
     * Hidden and deleted records are included as well, because they can become valid
     * records again at any time in the recycler.
     */
    private function getQueryBuilder(): QueryBuilder
    {
        $queryBuilder = $this->connectionPool->getQueryBuilderForTable(self::TABLE);
        $queryBuilder
            ->getRestrictions()
            ->removeAll();

        return $queryBuilder;
    }

    /**
     * @return string[]
     */
    public function getPrerequisites(): array
    {
        return [
            DatabaseUpdatedPrerequisite::class,
        ];
    }
}
