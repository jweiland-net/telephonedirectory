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
     * What
     *
     * @var string
     */
    protected $what = '';

    /**
     * Skill
     *
     * @var string
     */
    protected $skill = '';

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
     * Returns the what
     *
     * @return string
     */
    public function getWhat()
    {
        return $this->what;
    }

    /**
     * Sets the what
     *
     * @param string $what
     * @return void
     */
    public function setWhat($what)
    {
        $this->what = $what;
    }

    /**
     * Returns the skill
     *
     * @return string
     */
    public function getSkill()
    {
        return $this->skill;
    }

    /**
     * Sets the skill
     *
     * @param string $skill
     * @return void
     */
    public function setSkill($skill)
    {
        $this->skill = $skill;
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
