<?php

declare(strict_types=1);

/*
 * This file is part of the package jweiland/telephonedirectory.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace JWeiland\Telephonedirectory\Domain\Repository;

use Doctrine\DBAL\ArrayParameterType;
use JWeiland\Glossary2\Service\GlossaryService;
use JWeiland\Telephonedirectory\Domain\Model\Office;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Database\Query\QueryBuilder;
use TYPO3\CMS\Core\Database\Query\Restriction\FrontendRestrictionContainer;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Persistence\QueryResultInterface;
use TYPO3\CMS\Extbase\Persistence\Repository;

/**
 * Repository to get individual Queries for Employees
 */
class EmployeeRepository extends Repository
{
    private const TABLE = 'tx_telephonedirectory_domain_model_employee';

    protected GlossaryService $glossaryService;

    public function injectGlossaryService(GlossaryService $glossaryService): void
    {
        $this->glossaryService = $glossaryService;
    }

    public function findFilteredBy($office, array $search = []): QueryResultInterface
    {
        $query = $this->createQuery();
        $constraints = [];

        if ($office) {
            $constraints[] = $query->equals('office', $office);
        }

        if (isset($search['letter']) && (string)$search['letter'] !== '') {
            $constraints[] = $this->glossaryService->getLetterConstraintForExtbaseQuery(
                $query,
                'lastName',
                $search['letter'],
            );
        }

        if ($constraints === []) {
            return $query->execute();
        }

        return $query->matching($query->logicalAnd(...$constraints))->execute();
    }

    public function findBySearch(Office $office = null, string $search = ''): QueryResultInterface
    {
        $query = $this->createQuery();

        $constraintAnd = [];
        if ($office instanceof Office) {
            $constraintAnd[] = $query->equals('office', $office);
        }

        if ($search !== '') {
            $constraintOr = [];
            $constraintOr[] = $query->like('firstName', '%' . $search . '%');
            $constraintOr[] = $query->like('lastName', '%' . $search . '%');
            $constraintAnd[] = $query->logicalOr(...$constraintOr);
        }

        return $query->matching($query->logicalAnd(...$constraintAnd))->execute();
    }

    public function getQueryBuilderToFindAllEntries(int $office = 0): QueryBuilder
    {
        $query = $this->createQuery();
        $queryBuilder = $this->getConnectionPool()->getQueryBuilderForTable(self::TABLE);
        $queryBuilder->setRestrictions(GeneralUtility::makeInstance(FrontendRestrictionContainer::class));

        // Do not set any SELECT, ORDER BY, GROUP BY statement. It will be set by glossary2 API
        $queryBuilder
            ->from(self::TABLE)
            ->where(
                $queryBuilder->expr()->in(
                    'pid',
                    $queryBuilder->createNamedParameter(
                        $query->getQuerySettings()->getStoragePageIds(),
                        ArrayParameterType::INTEGER,
                    ),
                ),
            );

        if ($office) {
            $queryBuilder->andWhere($queryBuilder->expr()->eq('office', $office));
        }

        return $queryBuilder;
    }

    protected function getConnectionPool(): ConnectionPool
    {
        return GeneralUtility::makeInstance(ConnectionPool::class);
    }
}
