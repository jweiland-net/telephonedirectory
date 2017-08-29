<?php
namespace JWeiland\Telephonedirectory\Domain\Model;

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

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;

/**
 * @package telephonedirectory
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class Building extends AbstractEntity
{
    /**
     * Title
     *
     * @var string
     */
    protected $title = '';

    /**
     * Street
     *
     * @var string
     */
    protected $street = '';

    /**
     * House number
     *
     * @var string
     */
    protected $house_number = '';

    /**
     * Zip
     *
     * @var string
     */
    protected $zip = '';

    /**
     * City
     *
     * @var string
     */
    protected $city = '';

    /**
     * Returns the title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Sets the title
     *
     * @param string $title
     * @return void
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * Returns street
     *
     * @return string
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * Sets street
     *
     * @param string $street
     */
    public function setStreet($street)
    {
        $this->street = (string)$street;
    }

    /**
     * Returns house number
     *
     * @return string
     */
    public function getHouseNumber()
    {
        return $this->house_number;
    }

    /**
     * Sets house number
     *
     * @param string $house_number
     */
    public function setHouseNumber($house_number)
    {
        $this->house_number = (string)$house_number;
    }

    /**
     * Returns zip
     *
     * @return string
     */
    public function getZip()
    {
        return $this->zip;
    }

    /**
     * Sets zip
     *
     * @param string $zip
     */
    public function setZip($zip)
    {
        $this->zip = (string)$zip;
    }

    /**
     * Returns city
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Sets city
     *
     * @param string $city
     */
    public function setCity($city)
    {
        $this->city = (string)$city;
    }
}
