<?php

declare(strict_types=1);

/*
 * This file is part of the package jweiland/telephonedirectory.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace JWeiland\Telephonedirectory\Domain\Repository;

use TYPO3\CMS\Extbase\Persistence\QueryResultInterface;
use TYPO3\CMS\Extbase\Persistence\Repository;

/**
 * Repository to get individual Queries for LanguageSkills
 */
class LanguageSkillRepository extends Repository
{
    /**
     * Returns all languageSkills that are connected to a employee record
     */
    public function findAllWithEmployeeRelation(): QueryResultInterface
    {
        $query = $this->createQuery();
        $query->matching(
            $query->logicalAnd(
                $query->equals('employee.hidden', 0),
                $query->equals('employee.deleted', 0),
            ),
        );

        return $query->execute();
    }
}
