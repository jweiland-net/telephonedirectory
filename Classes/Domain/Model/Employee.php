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
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

/**
 * @package telephonedirectory
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class Employee extends AbstractEntity
{
    /**
     * First name
     *
     * @var string
     */
    protected $firstName = '';

    /**
     * Last name
     *
     * @var string
     */
    protected $lastName = '';

    /**
     * Name Additions
     *
     * @var string
     */
    protected $nameAdditions = '';

    /**
     * Subject Field
     *
     * @var string
     */
    protected $subjectField = '';

    /**
     * company
     *
     * @var string
     */
    protected $company = '';

    /**
     * roomNumber
     *
     * @var string
     */
    protected $roomNumber = '';

    /**
     * function
     *
     * @var string
     */
    protected $function = '';

    /**
     * additionalFunction
     *
     * @var string
     */
    protected $additionalFunction = '';

    /**
     * Telephone 1
     *
     * @var string
     */
    protected $telephone1 = '';

    /**
     * Telephone 2
     *
     * @var string
     */
    protected $telephone2 = '';

    /**
     * Telephone 3
     *
     * @var string
     */
    protected $telephone3 = '';

    /**
     * Mobile
     *
     * @var string
     */
    protected $mobile = '';

    /**
     * pager
     *
     * @var string
     */
    protected $pager = '';

    /**
     * Fax
     *
     * @var string
     */
    protected $fax = '';

    /**
     * Pc Fax
     *
     * @var string
     */
    protected $pcFax = '';

    /**
     * E-Mail
     * @var string
     * @validate EmailAddress
     */
    protected $email = '';

    /**
     * Additional Informations
     *
     * @var string
     */
    protected $additionalInformations = '';

    /**
     * send HTML-Mail?
     *
     * @var boolean
     */
    protected $moduleSysDmailHtml = true;

    /**
     * Office
     *
     * @var \JWeiland\Telephonedirectory\Domain\Model\Office
     * @lazy
     */
    protected $office;

    /**
     * Building
     *
     * @var \JWeiland\Telephonedirectory\Domain\Model\Building
     * @lazy
     */
    protected $building;

    /**
     * Department
     *
     * @var \JWeiland\Telephonedirectory\Domain\Model\Department
     * @lazy
     */
    protected $department;

    /**
     * image
     *
     * @var string
     */
    protected $image = '';

    /**
     * Language Skill
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\JWeiland\Telephonedirectory\Domain\Model\LanguageSkill>
     * @lazy
     */
    protected $languageSkill;

    /**
     * __construct
     */
    public function __construct()
    {
        //Do not remove the next line: It would break the functionality
        $this->initStorageObjects();
    }

    /**
     * Initializes all \TYPO3\CMS\Extbase\Persistence\ObjectStorage properties.
     *
     * @return void
     */
    protected function initStorageObjects()
    {
        /**
         * Do not modify this method!
         * It will be rewritten on each save in the extension builder
         * You may modify the constructor of this class instead
         */
        $this->languageSkill = new ObjectStorage();
    }

    /**
     * Returns the firstName
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Sets the firstName
     *
     * @param string $firstName
     * @return void
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * Returns the lastName
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Sets the lastName
     *
     * @param string $lastName
     * @return void
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * Returns the nameAdditions
     *
     * @return string
     */
    public function getNameAdditions()
    {
        return $this->nameAdditions;
    }

    /**
     * Sets the nameAdditions
     *
     * @param string $nameAdditions
     * @return void
     */
    public function setNameAdditions($nameAdditions)
    {
        $this->nameAdditions = $nameAdditions;
    }

    /**
     * Returns the subjectField
     *
     * @return string
     */
    public function getSubjectField()
    {
        return $this->subjectField;
    }

    /**
     * Sets the subjectField
     *
     * @param string $subjectField
     * @return void
     */
    public function setSubjectField($subjectField)
    {
        $this->subjectField = $subjectField;
    }

    /**
     * Returns the company
     *
     * @return string $company
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * Sets the company
     *
     * @param string $company
     * @return void
     */
    public function setCompany($company)
    {
        $this->company = $company;
    }

    /**
     * Returns the roomNumber
     *
     * @return string
     */
    public function getRoomNumber()
    {
        return $this->roomNumber;
    }

    /**
     * Sets the roomNumber
     *
     * @param string $roomNumber
     * @return void
     */
    public function setRoomNumber($roomNumber)
    {
        $this->roomNumber = $roomNumber;
    }

    /**
     * Returns the function
     *
     * @return string
     */
    public function getFunction()
    {
        return $this->function;
    }

    /**
     * Sets the function
     *
     * @param string $function
     * @return void
     */
    public function setFunction($function)
    {
        $this->function = $function;
    }

    /**
     * Returns the additionalFunction
     *
     * @return string
     */
    public function getAdditionalFunction()
    {
        return $this->additionalFunction;
    }

    /**
     * Sets the additionalFunction
     *
     * @param string $additionalFunction
     * @return void
     */
    public function setAdditionalFunction($additionalFunction)
    {
        $this->additionalFunction = $additionalFunction;
    }

    /**
     * Returns the telephone1
     *
     * @return string
     */
    public function getTelephone1()
    {
        return $this->telephone1;
    }

    /**
     * Sets the telephone1
     *
     * @param string $telephone1
     * @return void
     */
    public function setTelephone1($telephone1)
    {
        $this->telephone1 = $telephone1;
    }

    /**
     * Returns the telephone2
     *
     * @return string
     */
    public function getTelephone2()
    {
        return $this->telephone2;
    }

    /**
     * Sets the telephone2
     *
     * @param string $telephone2
     * @return void
     */
    public function setTelephone2($telephone2)
    {
        $this->telephone2 = $telephone2;
    }

    /**
     * Returns the telephone3
     *
     * @return string
     */
    public function getTelephone3()
    {
        return $this->telephone3;
    }

    /**
     * Sets the telephone3
     *
     * @param string $telephone3
     * @return void
     */
    public function setTelephone3($telephone3)
    {
        $this->telephone3 = $telephone3;
    }

    /**
     * Returns the mobile
     *
     * @return string
     */
    public function getMobile()
    {
        return $this->mobile;
    }

    /**
     * Sets the mobile
     *
     * @param string $mobile
     * @return void
     */
    public function setMobile($mobile)
    {
        $this->mobile = $mobile;
    }

    /**
     * Returns the pager
     *
     * @return string
     */
    public function getPager()
    {
        return $this->pager;
    }

    /**
     * Sets the pager
     *
     * @param string $pager
     * @return void
     */
    public function setPager($pager)
    {
        $this->pager = $pager;
    }

    /**
     * Returns the fax
     *
     * @return string
     */
    public function getFax()
    {
        return $this->fax;
    }

    /**
     * Sets the fax
     *
     * @param string $fax
     * @return void
     */
    public function setFax($fax)
    {
        $this->fax = $fax;
    }

    /**
     * Returns the pcFax
     *
     * @return string $pcFax
     */
    public function getPcFax()
    {
        return $this->pcFax;
    }

    /**
     * Sets the pcFax
     *
     * @param string $pcFax
     * @return void
     */
    public function setPcFax($pcFax)
    {
        $this->pcFax = $pcFax;
    }

    /**
     * Returns the email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Sets the email
     *
     * @param string $email
     * @return void
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * Returns the additionalInformations
     *
     * @return string
     */
    public function getAdditionalInformations()
    {
        return $this->additionalInformations;
    }

    /**
     * Sets the additionalInformations
     *
     * @param string $additionalInformations
     * @return void
     */
    public function setAdditionalInformations($additionalInformations)
    {
        $this->additionalInformations = $additionalInformations;
    }

    /**
     * Returns the moduleSysDmailHtml
     *
     * @return boolean
     */
    public function getModuleSysDmailHtml()
    {
        return $this->moduleSysDmailHtml;
    }

    /**
     * Sets the moduleSysDmailHtml
     *
     * @param boolean $moduleSysDmailHtml
     * @return void
     */
    public function setModuleSysDmailHtml($moduleSysDmailHtml)
    {
        $this->moduleSysDmailHtml = $moduleSysDmailHtml;
    }

    /**
     * Returns the office
     *
     * @return Office
     */
    public function getOffice()
    {
        return $this->office;
    }

    /**
     * Sets the office
     *
     * @param Office $office
     * @return void
     */
    public function setOffice(Office $office = null)
    {
        $this->office = $office;
    }

    /**
     * Returns the building
     *
     * @return Building
     */
    public function getBuilding()
    {
        return $this->building;
    }

    /**
     * Sets the building
     *
     * @param Building $building
     * @return void
     */
    public function setBuilding(Building $building = null)
    {
        $this->building = $building;
    }

    /**
     * Returns the department
     *
     * @return Department
     */
    public function getDepartment()
    {
        return $this->department;
    }

    /**
     * Sets the department
     *
     * @param Department $department
     * @return void
     */
    public function setDepartment(Department $department = null)
    {
        $this->department = $department;
    }

    /**
     * Returns the image
     *
     * @return string $image
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Sets the image
     *
     * @param string $image
     * @return void
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * Adds a LanguageSkill
     *
     * @param LanguageSkill $languageSkill
     * @return void
     */
    public function addLanguageSkill(LanguageSkill $languageSkill = null)
    {
        $this->languageSkill->attach($languageSkill);
    }

    /**
     * Removes a LanguageSkill
     *
     * @param LanguageSkill $languageSkillToRemove The LanguageSkill to be removed
     * @return void
     */
    public function removeLanguageSkill(LanguageSkill $languageSkillToRemove)
    {
        $this->languageSkill->detach($languageSkillToRemove);
    }

    /**
     * Returns the languageSkill
     *
     * @return ObjectStorage
     */
    public function getLanguageSkill()
    {
        return $this->languageSkill;
    }

    /**
     * Sets the languageSkill
     *
     * @param ObjectStorage $languageSkill
     * @return void
     */
    public function setLanguageSkill(ObjectStorage $languageSkill = null)
    {
        $this->languageSkill = $languageSkill;
    }
}
