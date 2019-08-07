<?php
declare(strict_types = 1);
namespace JWeiland\Telephonedirectory\Domain\Model;

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

use TYPO3\CMS\Extbase\Domain\Model\Category;
use TYPO3\CMS\Extbase\Domain\Model\FileReference;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

/**
 * Class which contains all setters and getters for Employee
 */
class Employee extends AbstractEntity
{
    /**
     * @var bool
     */
    protected $hidden = true;

    /**
     * @var int
     */
    protected $title = 0;

    /**
     * @var string
     */
    protected $firstName = '';

    /**
     * @var string
     */
    protected $lastName = '';

    /**
     * @var string
     */
    protected $nameAdditions = '';

    /**
     * @var bool
     */
    protected $isCatchAllMail = false;

    /**
     * @var \JWeiland\Telephonedirectory\Domain\Model\SubjectField
     */
    protected $subjectField;

    /**
     * @var string
     */
    protected $company = '';

    /**
     * @var string
     */
    protected $roomNumber = '';

    /**
     * @var string
     */
    protected $function = '';

    /**
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\Category>
     */
    protected $additionalFunction = '';

    /**
     * @var string
     */
    protected $telephone1 = '';

    /**
     * @var string
     */
    protected $telephone2 = '';

    /**
     * @var string
     */
    protected $telephone3 = '';

    /**
     * @var string
     */
    protected $mobile = '';

    /**
     * @var string
     */
    protected $pager = '';

    /**
     * @var string
     */
    protected $fax = '';

    /**
     * @var string
     */
    protected $pcFax = '';

    /**
     * @var string
     * @validate EmailAddress
     */
    protected $email = '';

    /**
     * @var string
     */
    protected $additionalInformations = '';

    /**
     * @var string
     */
    protected $regularAttendance = '';

    /**
     * @var bool
     */
    protected $moduleSysDmailHtml = true;

    /**
     * @var \JWeiland\Telephonedirectory\Domain\Model\Office
     * @lazy
     */
    protected $office;

    /**
     * @var \JWeiland\Telephonedirectory\Domain\Model\Building
     * @lazy
     */
    protected $building;

    /**
     * @var \JWeiland\Telephonedirectory\Domain\Model\Department
     * @lazy
     */
    protected $department;

    /**
     * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
     */
    protected $image;

    /**
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\JWeiland\Telephonedirectory\Domain\Model\LanguageSkill>
     * @lazy
     */
    protected $languageSkill;

    public function __construct()
    {
        //Do not remove the next line: It would break the functionality
        $this->initStorageObjects();
    }

    /**
     * Initializes all \TYPO3\CMS\Extbase\Persistence\ObjectStorage properties.
     */
    protected function initStorageObjects()
    {
        $this->additionalFunction = new ObjectStorage();
        $this->languageSkill = new ObjectStorage();
    }

    /**
     * @return bool
     */
    public function isHidden(): bool
    {
        return $this->hidden;
    }

    /**
     * @param bool $hidden
     */
    public function setHidden(bool $hidden)
    {
        $this->hidden = $hidden;
    }

    /**
     * @return int
     */
    public function getTitle(): int
    {
        return $this->title;
    }

    /**
     * @param int $title
     */
    public function setTitle(int $title)
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     */
    public function setFirstName(string $firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     */
    public function setLastName(string $lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * @return string
     */
    public function getNameAdditions(): string
    {
        return $this->nameAdditions;
    }

    /**
     * @param string $nameAdditions
     */
    public function setNameAdditions(string $nameAdditions)
    {
        $this->nameAdditions = $nameAdditions;
    }

    /**
     * @return bool
     */
    public function getIsCatchAllMail(): bool
    {
        return $this->isCatchAllMail;
    }

    /**
     * @param bool $isCatchAllMail
     */
    public function setIsCatchAllMail(bool $isCatchAllMail)
    {
        $this->isCatchAllMail = $isCatchAllMail;
    }

    /**
     * @return SubjectField
     */
    public function getSubjectField()
    {
        return $this->subjectField;
    }

    /**
     * @param SubjectField $subjectField
     */
    public function setSubjectField(SubjectField $subjectField = null)
    {
        $this->subjectField = $subjectField;
    }

    /**
     * @return string $company
     */
    public function getCompany(): string
    {
        return $this->company;
    }

    /**
     * @param string $company
     */
    public function setCompany(string $company)
    {
        $this->company = $company;
    }

    /**
     * @return string
     */
    public function getRoomNumber(): string
    {
        return $this->roomNumber;
    }

    /**
     * @param string $roomNumber
     */
    public function setRoomNumber(string $roomNumber)
    {
        $this->roomNumber = $roomNumber;
    }

    /**
     * @return string
     */
    public function getFunction(): string
    {
        return $this->function;
    }

    /**
     * @param string $function
     */
    public function setFunction(string $function)
    {
        $this->function = $function;
    }

    /**
     * @return ObjectStorage
     */
    public function getAdditionalFunction()
    {
        return $this->additionalFunction;
    }

    /**
     * @param ObjectStorage $additionalFunction
     */
    public function setAdditionalFunction(ObjectStorage $additionalFunction)
    {
        $this->additionalFunction = $additionalFunction;
    }

    /**
     * @param Category $additionalFunction
     */
    public function addAdditionalFunction(Category $additionalFunction = null)
    {
        $this->additionalFunction->attach($additionalFunction);
    }

    /**
     * @param Category $additionalFunction
     */
    public function removeAdditionalFunction(Category $additionalFunction)
    {
        $this->additionalFunction->detach($additionalFunction);
    }

    /**
     * @return string
     */
    public function getTelephone1(): string
    {
        return $this->telephone1;
    }

    /**
     * @param string $telephone1
     */
    public function setTelephone1(string $telephone1)
    {
        $this->telephone1 = $telephone1;
    }

    /**
     * @return string
     */
    public function getTelephone2(): string
    {
        return $this->telephone2;
    }

    /**
     * @param string $telephone2
     */
    public function setTelephone2(string $telephone2)
    {
        $this->telephone2 = $telephone2;
    }

    /**
     * @return string
     */
    public function getTelephone3(): string
    {
        return $this->telephone3;
    }

    /**
     * @param string $telephone3
     */
    public function setTelephone3(string $telephone3)
    {
        $this->telephone3 = $telephone3;
    }

    /**
     * @return string
     */
    public function getMobile(): string
    {
        return $this->mobile;
    }

    /**
     * @param string $mobile
     */
    public function setMobile(string $mobile)
    {
        $this->mobile = $mobile;
    }

    /**
     * @return string
     */
    public function getPager(): string
    {
        return $this->pager;
    }

    /**
     * @param string $pager
     */
    public function setPager(string $pager)
    {
        $this->pager = $pager;
    }

    /**
     * @return string
     */
    public function getFax(): string
    {
        return $this->fax;
    }

    /**
     * @param string $fax
     */
    public function setFax(string $fax)
    {
        $this->fax = $fax;
    }

    /**
     * @return string $pcFax
     */
    public function getPcFax(): string
    {
        return $this->pcFax;
    }

    /**
     * @param string $pcFax
     */
    public function setPcFax(string $pcFax)
    {
        $this->pcFax = $pcFax;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getAdditionalInformations(): string
    {
        return $this->additionalInformations;
    }

    /**
     * @param string $additionalInformations
     */
    public function setAdditionalInformations(string $additionalInformations)
    {
        $this->additionalInformations = $additionalInformations;
    }

    /**
     * @return string
     */
    public function getRegularAttendance(): string
    {
        return $this->regularAttendance;
    }

    /**
     * @param string $regularAttendance
     */
    public function setRegularAttendance(string $regularAttendance)
    {
        $this->regularAttendance = $regularAttendance;
    }

    /**
     * @return bool
     */
    public function getModuleSysDmailHtml(): bool
    {
        return $this->moduleSysDmailHtml;
    }

    /**
     * @param bool $moduleSysDmailHtml
     */
    public function setModuleSysDmailHtml(bool $moduleSysDmailHtml)
    {
        $this->moduleSysDmailHtml = $moduleSysDmailHtml;
    }

    /**
     * @return Office
     */
    public function getOffice()
    {
        return $this->office;
    }

    /**
     * @param Office|null $office
     */
    public function setOffice(Office $office = null)
    {
        $this->office = $office;
    }

    /**
     * @return Building
     */
    public function getBuilding()
    {
        return $this->building;
    }

    /**
     * @param Building|null $building
     */
    public function setBuilding(Building $building = null)
    {
        $this->building = $building;
    }

    /**
     * @return Department
     */
    public function getDepartment()
    {
        return $this->department;
    }

    /**
     * @param Department $department
     */
    public function setDepartment(Department $department = null)
    {
        $this->department = $department;
    }

    /**
     * @return FileReference $image
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param FileReference $image
     */
    public function setImage(FileReference $image = null)
    {
        if ($image) {
            $this->image = $image;
        }
    }

    /**
     * @param LanguageSkill $languageSkill
     */
    public function addLanguageSkill(LanguageSkill $languageSkill = null)
    {
        $this->languageSkill->attach($languageSkill);
    }

    /**
     * @param LanguageSkill $languageSkillToRemove
     */
    public function removeLanguageSkill(LanguageSkill $languageSkillToRemove)
    {
        $this->languageSkill->detach($languageSkillToRemove);
    }

    /**
     * @return ObjectStorage
     */
    public function getLanguageSkill(): ObjectStorage
    {
        return $this->languageSkill;
    }

    /**
     * @param ObjectStorage $languageSkill
     */
    public function setLanguageSkill(ObjectStorage $languageSkill = null)
    {
        $this->languageSkill = $languageSkill;
    }
}
