<?php

declare(strict_types=1);

/*
 * This file is part of the package jweiland/telephonedirectory.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace JWeiland\Telephonedirectory\Domain\Repository;

use JWeiland\Telephonedirectory\Domain\Model\Office;
use TYPO3\CMS\Extbase\Persistence\QueryResultInterface;
use TYPO3\CMS\Extbase\Persistence\Repository;

/**
 * Repository to get individual Queries for Employees
 */
class EmployeeRepository extends Repository
{
    /**
     * Search
     *
     * @param Office $office
     * @param string $search
     * @return QueryResultInterface
     */
    public function findBySearch(Office $office = null, $search = ''): QueryResultInterface
    {
        $query = $this->createQuery();

        $constraintAnd = [];
        if ($office instanceof Office) {
            $constraintAnd[] = $query->equals('office', $office);
        }
        if (!empty($search)) {
            $constraintOr = [];
            $constraintOr[] = $query->like('firstName', '%' . $search . '%');
            $constraintOr[] = $query->like('lastName', '%' . $search . '%');
            $constraintAnd[] = $query->logicalOr($constraintOr);
        }

        return $query->matching($query->logicalAnd($constraintAnd))->execute();
    }
}
