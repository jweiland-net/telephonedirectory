<?php
declare(strict_types=1);
namespace JWeiland\Telephonedirectory\Domain\Model;

/*
 * This file is part of the TYPO3 CMS project.
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

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

/**
 * Class Employee
 *
 * @package JWeiland\Telephonedirectory\Domain\Model
 */
class Employee extends AbstractEntity
{
    /**
     * @var bool
     */
    protected $hidden = true;

    /**
     * title
     *
     * @var int
     */
    protected $title = 0;

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
     * is catch all mail
     *
     * @var bool
     */
    protected $isCatchAllMail = false;

    /**
     * Subject Field
     *
     * @var \JWeiland\Telephonedirectory\Domain\Model\SubjectField
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
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\Category>
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
     * Regular attendance
     *
     * @var string
     */
    protected $regularAttendance = '';

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
     * Returns hidden
     *
     * @return bool
     */
    public function isHidden(): bool
    {
        return $this->hidden;
    }

    /**
     * Sets hidden
     *
     * @param bool $hidden
     */
    public function setHidden(bool $hidden)
    {
        $this->hidden = $hidden;
    }

    /**
     * Returns title
     *
     * @return int
     */
    public function getTitle(): int
    {
        return $this->title;
    }

    /**
     * Sets title
     *
     * @param int $title
     */
    public function setTitle(int $title)
    {
        $this->title = $title;
    }

    /**
     * Returns the firstName
     *
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * Sets the firstName
     *
     * @param string $firstName
     * @return void
     */
    public function setFirstName(string $firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * Returns the lastName
     *
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * Sets the lastName
     *
     * @param string $lastName
     * @return void
     */
    public function setLastName(string $lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * Returns the nameAdditions
     *
     * @return string
     */
    public function getNameAdditions(): string
    {
        return $this->nameAdditions;
    }

    /**
     * Sets the nameAdditions
     *
     * @param string $nameAdditions
     * @return void
     */
    public function setNameAdditions(string $nameAdditions)
    {
        $this->nameAdditions = $nameAdditions;
    }

    /**
     * Returns is catch all mail
     *
     * @return bool
     */
    public function getIsCatchAllMail(): bool
    {
        return $this->isCatchAllMail;
    }

    /**
     * Gets is catch all mail
     *
     * @param bool $isCatchAllMail
     */
    public function setIsCatchAllMail(bool $isCatchAllMail)
    {
        $this->isCatchAllMail = $isCatchAllMail;
    }

    /**
     * Returns the subject field
     *
     * @return SubjectField
     */
    public function getSubjectField()
    {
        return $this->subjectField;
    }

    /**
     * Sets the subject field
     *
     * @param SubjectField $subjectField
     * @return void
     */
    public function setSubjectField(SubjectField $subjectField)
    {
        $this->languageSkill = $subjectField;
    }

    /**
     * Returns the company
     *
     * @return string $company
     */
    public function getCompany(): string
    {
        return $this->company;
    }

    /**
     * Sets the company
     *
     * @param string $company
     * @return void
     */
    public function setCompany(string $company)
    {
        $this->company = $company;
    }

    /**
     * Returns the roomNumber
     *
     * @return string
     */
    public function getRoomNumber(): string
    {
        return $this->roomNumber;
    }

    /**
     * Sets the roomNumber
     *
     * @param string $roomNumber
     * @return void
     */
    public function setRoomNumber(string $roomNumber)
    {
        $this->roomNumber = $roomNumber;
    }

    /**
     * Returns the function
     *
     * @return string
     */
    public function getFunction(): string
    {
        return $this->function;
    }

    /**
     * Sets the function
     *
     * @param string $function
     * @return void
     */
    public function setFunction(string $function)
    {
        $this->function = $function;
    }

    /**
     * Returns the additionalFunction
     *
     * @return ObjectStorage
     */
    public function getAdditionalFunction()
    {
        return $this->additionalFunction;
    }

    /**
     * Sets the additionalFunction
     *
     * @param ObjectStorage $additionalFunction
     * @return void
     */
    public function setAdditionalFunction(ObjectStorage $additionalFunction)
    {
        $this->additionalFunction = $additionalFunction;
    }

    /**
     * Returns the telephone1
     *
     * @return string
     */
    public function getTelephone1(): string
    {
        return $this->telephone1;
    }

    /**
     * Sets the telephone1
     *
     * @param string $telephone1
     * @return void
     */
    public function setTelephone1(string $telephone1)
    {
        $this->telephone1 = $telephone1;
    }

    /**
     * Returns the telephone2
     *
     * @return string
     */
    public function getTelephone2(): string
    {
        return $this->telephone2;
    }

    /**
     * Sets the telephone2
     *
     * @param string $telephone2
     * @return void
     */
    public function setTelephone2(string $telephone2)
    {
        $this->telephone2 = $telephone2;
    }

    /**
     * Returns the telephone3
     *
     * @return string
     */
    public function getTelephone3(): string
    {
        return $this->telephone3;
    }

    /**
     * Sets the telephone3
     *
     * @param string $telephone3
     * @return void
     */
    public function setTelephone3(string $telephone3)
    {
        $this->telephone3 = $telephone3;
    }

    /**
     * Returns the mobile
     *
     * @return string
     */
    public function getMobile(): string
    {
        return $this->mobile;
    }

    /**
     * Sets the mobile
     *
     * @param string $mobile
     * @return void
     */
    public function setMobile(string $mobile)
    {
        $this->mobile = $mobile;
    }

    /**
     * Returns the pager
     *
     * @return string
     */
    public function getPager(): string
    {
        return $this->pager;
    }

    /**
     * Sets the pager
     *
     * @param string $pager
     * @return void
     */
    public function setPager(string $pager)
    {
        $this->pager = $pager;
    }

    /**
     * Returns the fax
     *
     * @return string
     */
    public function getFax(): string
    {
        return $this->fax;
    }

    /**
     * Sets the fax
     *
     * @param string $fax
     * @return void
     */
    public function setFax(string $fax)
    {
        $this->fax = $fax;
    }

    /**
     * Returns the pcFax
     *
     * @return string $pcFax
     */
    public function getPcFax(): string
    {
        return $this->pcFax;
    }

    /**
     * Sets the pcFax
     *
     * @param string $pcFax
     * @return void
     */
    public function setPcFax(string $pcFax)
    {
        $this->pcFax = $pcFax;
    }

    /**
     * Returns the email
     *
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * Sets the email
     *
     * @param string $email
     * @return void
     */
    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    /**
     * Returns the additionalInformations
     *
     * @return string
     */
    public function getAdditionalInformations(): string
    {
        return $this->additionalInformations;
    }

    /**
     * Sets the additionalInformations
     *
     * @param string $additionalInformations
     * @return void
     */
    public function setAdditionalInformations(string $additionalInformations)
    {
        $this->additionalInformations = $additionalInformations;
    }

    /**
     * Returns regular attendance
     *
     * @return string
     */
    public function getRegularAttendance(): string
    {
        return $this->regularAttendance;
    }

    /**
     * Sets regular attendance
     *
     * @param string $regularAttendance
     */
    public function setRegularAttendance(string $regularAttendance)
    {
        $this->regularAttendance = $regularAttendance;
    }

    /**
     * Returns the moduleSysDmailHtml
     *
     * @return bool
     */
    public function getModuleSysDmailHtml(): bool
    {
        return $this->moduleSysDmailHtml;
    }

    /**
     * Sets the moduleSysDmailHtml
     *
     * @param bool $moduleSysDmailHtml
     * @return void
     */
    public function setModuleSysDmailHtml(bool $moduleSysDmailHtml)
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
    public function getImage(): string
    {
        return $this->image;
    }

    /**
     * Sets the image
     *
     * @param string $image
     * @return void
     */
    public function setImage(string $image)
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
