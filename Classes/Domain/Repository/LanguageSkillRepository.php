<?php
declare(strict_types=1);
namespace JWeiland\Telephonedirectory\Domain\Repository;

/*
 * This file is part of the telephonedirectory project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */
use TYPO3\CMS\Extbase\Persistence\Repository;

/**
 * Repository to get individual Queries for LanguageSkills
 */
class LanguageSkillRepository extends Repository
{
    /**
     * Returns all languageskills that are connected to a employee record
     *
     * @return array|\TYPO3\CMS\Extbase\Persistence\QueryResultInterface
     */
    public function findAllWithEmployeeRelation()
    {
        $query = $this->createQuery();

        $query->matching(
            $query->logicalAnd(
                [
                $query->equals('employee.hidden', 0),
                $query->equals('employee.deleted', 0)
                ]
            )
        );
        return $query->execute();
    }
}
