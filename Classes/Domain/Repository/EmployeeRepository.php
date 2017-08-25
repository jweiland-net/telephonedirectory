<?php
namespace JWeiland\Telephonedirectory\Domain\Repository;

/***************************************************************
 *  Copyright notice
 *  (c) 2013 Stefan Froemken <sfroemken@gmail.com>, jweiland.net
 *  All rights reserved
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

use JWeiland\Telephonedirectory\Domain\Model\Office;
use TYPO3\CMS\Extbase\Persistence\QueryInterface;
use TYPO3\CMS\Extbase\Persistence\Repository;

/**
 * @package telephonedirectory
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class EmployeeRepository extends Repository
{
    /**
     * @var array
     */
    protected $defaultOrderings = array(
        'lastName' => QueryInterface::ORDER_ASCENDING,
        'firstName' => QueryInterface::ORDER_ASCENDING,
    );

    /**
     * search
     *
     * @param Office $office
     * @param string $search
     * @return array|QueryInterface
     */
    public function findBySearch(Office $office = null, $search = '')
    {
        $query = $this->createQuery();

        $constraintAnd = array();
        if ($office instanceof Office) {
            $constraintAnd[] = $query->equals('office', $office);
        }
        if (!empty($search)) {
            $constraintOr = array();
            $constraintOr[] = $query->like('firstName', '%' . $search . '%');
            $constraintOr[] = $query->like('lastName', '%' . $search . '%');
            $constraintAnd[] = $query->logicalOr($constraintOr);
        }

        return $query->matching($query->logicalAnd($constraintAnd))->execute();
    }
}
