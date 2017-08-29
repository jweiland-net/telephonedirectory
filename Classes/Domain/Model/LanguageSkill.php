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
class LanguageSkill extends AbstractEntity
{
    /**
     * Language
     *
     * @var string
     */
    protected $language = '';

    /**
     * writing
     *
     * @var string
     */
    protected $writing = '';

    /**
     * speaking
     *
     * @var string
     */
    protected $speaking = '';

    /**
     * Infotext
     *
     * @var string
     */
    protected $infotext = '';

    /**
     * Employee
     *
     * @var \JWeiland\Telephonedirectory\Domain\Model\Employee
     */
    protected $employee;

    /**
     * Returns the language
     *
     * @return string
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * Sets the language
     *
     * @param string $language
     * @return void
     */
    public function setLanguage($language)
    {
        $this->language = $language;
    }

    /**
     * Returns writing
     *
     * @return string
     */
    public function getWriting()
    {
        return $this->writing;
    }

    /**
     * Sets writing
     *
     * @param string $writing
     * @return void
     */
    public function setWriting($writing)
    {
        $this->writing = $writing;
    }

    /**
     * Returns speaking
     *
     * @return string
     */
    public function getSpeaking()
    {
        return $this->speaking;
    }

    /**
     * Sets speaking
     *
     * @param string $speaking
     * @return void
     */
    public function setSpeaking($speaking)
    {
        $this->speaking = $speaking;
    }

    /**
     * Returns the infotext
     *
     * @return string
     */
    public function getInfotext()
    {
        return $this->infotext;
    }

    /**
     * Sets the infotext
     *
     * @param string $infotext
     * @return void
     */
    public function setInfotext($infotext)
    {
        $this->infotext = $infotext;
    }

    /**
     * Returns the employee
     *
     * @return Employee $employee
     */
    public function getEmployee()
    {
        return $this->employee;
    }

    /**
     * Sets the employee
     *
     * @param Employee $employee
     * @return void
     */
    public function setEmployee($employee)
    {
        $this->employee = $employee;
    }
}
