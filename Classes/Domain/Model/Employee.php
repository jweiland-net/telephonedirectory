<?php

declare(strict_types=1);

/*
 * This file is part of the package jweiland/telephonedirectory.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace JWeiland\Telephonedirectory\Domain\Model;

use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;
use TYPO3\CMS\Extbase\Annotation\Validate;
use TYPO3\CMS\Extbase\Domain\Model\FileReference;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

/**
 * Class which contains all setters and getters for Employee
 */
class Employee extends AbstractEntity
{
    protected bool $hidden = true;

    protected int $title = 0;

    protected string $pathSegment = '';

    protected string $firstName = '';

    protected string $lastName = '';

    protected string $nameAdditions = '';

    protected bool $isCatchAllMail = false;

    protected ?SubjectField $subjectField = null;

    protected string $company = '';

    protected string $roomNumber = '';

    protected string $function = '';

    /**
     * @var ObjectStorage<Category>
     */
    protected ObjectStorage $additionalFunction;

    protected string $telephone1 = '';

    protected string $telephone2 = '';

    protected string $telephone3 = '';

    protected string $mobile = '';

    protected string $pager = '';

    protected string $fax = '';

    protected string $pcFax = '';

    /**
     * @Validate("EmailAddress")
     */
    protected string $email = '';

    protected string $additionalInformations = '';

    protected string $regularAttendance = '';

    protected bool $moduleSysDmailHtml = true;

    protected ?Office $office = null;

    protected ?Building $building = null;

    protected ?Department $department = null;

    /**
     * @var ObjectStorage<FileReference>
     */
    protected ObjectStorage $image;

    /**
     * @var ObjectStorage<LanguageSkill>
     * @Lazy
     */
    protected ObjectStorage $languageSkill;

    public function __construct()
    {
        // Do not remove the next line: It would break the functionality
        $this->initStorageObjects();
    }

    protected function initStorageObjects(): void
    {
        $this->additionalFunction = new ObjectStorage();
        $this->languageSkill = new ObjectStorage();
        $this->image = new ObjectStorage();
    }

    public function isHidden(): bool
    {
        return $this->hidden;
    }

    public function setHidden(bool $hidden): void
    {
        $this->hidden = $hidden;
    }

    public function getTitle(): int
    {
        return $this->title;
    }

    public function setTitle(int $title): void
    {
        $this->title = $title;
    }

    public function getPathSegment(): string
    {
        return $this->pathSegment;
    }

    public function setPathSegment(string $pathSegment): void
    {
        $this->pathSegment = $pathSegment;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }

    public function getNameAdditions(): string
    {
        return $this->nameAdditions;
    }

    public function setNameAdditions(string $nameAdditions): void
    {
        $this->nameAdditions = $nameAdditions;
    }

    public function getIsCatchAllMail(): bool
    {
        return $this->isCatchAllMail;
    }

    public function setIsCatchAllMail(bool $isCatchAllMail): void
    {
        $this->isCatchAllMail = $isCatchAllMail;
    }

    public function getSubjectField(): ?SubjectField
    {
        return $this->subjectField;
    }

    public function setSubjectField(?SubjectField $subjectField): void
    {
        $this->subjectField = $subjectField;
    }

    public function getCompany(): string
    {
        return $this->company;
    }

    public function setCompany(string $company): void
    {
        $this->company = $company;
    }

    public function getRoomNumber(): string
    {
        return $this->roomNumber;
    }

    public function setRoomNumber(string $roomNumber): void
    {
        $this->roomNumber = $roomNumber;
    }

    public function getFunction(): string
    {
        return $this->function;
    }

    public function setFunction(string $function): void
    {
        $this->function = $function;
    }

    public function getAdditionalFunction(): ObjectStorage
    {
        return $this->additionalFunction;
    }

    public function setAdditionalFunction(ObjectStorage $additionalFunction): void
    {
        $this->additionalFunction = $additionalFunction;
    }

    public function addAdditionalFunction(Category $additionalFunction): void
    {
        $this->additionalFunction->attach($additionalFunction);
    }

    public function removeAdditionalFunction(Category $additionalFunction): void
    {
        $this->additionalFunction->detach($additionalFunction);
    }

    public function getTelephone1(): string
    {
        return $this->telephone1;
    }

    public function setTelephone1(string $telephone1): void
    {
        $this->telephone1 = $telephone1;
    }

    public function getTelephone2(): string
    {
        return $this->telephone2;
    }

    public function setTelephone2(string $telephone2): void
    {
        $this->telephone2 = $telephone2;
    }

    public function getTelephone3(): string
    {
        return $this->telephone3;
    }

    public function setTelephone3(string $telephone3): void
    {
        $this->telephone3 = $telephone3;
    }

    public function getMobile(): string
    {
        return $this->mobile;
    }

    public function setMobile(string $mobile): void
    {
        $this->mobile = $mobile;
    }

    public function getPager(): string
    {
        return $this->pager;
    }

    public function setPager(string $pager): void
    {
        $this->pager = $pager;
    }

    public function getFax(): string
    {
        return $this->fax;
    }

    public function setFax(string $fax): void
    {
        $this->fax = $fax;
    }

    public function getPcFax(): string
    {
        return $this->pcFax;
    }

    public function setPcFax(string $pcFax): void
    {
        $this->pcFax = $pcFax;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getAdditionalInformations(): string
    {
        return $this->additionalInformations;
    }

    public function setAdditionalInformations(string $additionalInformations): void
    {
        $this->additionalInformations = $additionalInformations;
    }

    public function getRegularAttendance(): string
    {
        return $this->regularAttendance;
    }

    public function setRegularAttendance(string $regularAttendance): void
    {
        $this->regularAttendance = $regularAttendance;
    }

    public function getModuleSysDmailHtml(): bool
    {
        return $this->moduleSysDmailHtml;
    }

    public function setModuleSysDmailHtml(bool $moduleSysDmailHtml): void
    {
        $this->moduleSysDmailHtml = $moduleSysDmailHtml;
    }

    public function getOffice(): ?Office
    {
        return $this->office;
    }

    public function setOffice(Office $office = null): void
    {
        $this->office = $office;
    }

    public function getBuilding(): ?Building
    {
        return $this->building;
    }

    public function setBuilding(Building $building): void
    {
        $this->building = $building;
    }

    public function getDepartment(): ?Department
    {
        return $this->department;
    }

    public function setDepartment(?Department $department): void
    {
        $this->department = $department;
    }

    public function getFirstImage(): ?FileReference
    {
        $this->image->rewind();
        return $this->image->current();
    }

    public function getImage(): ObjectStorage
    {
        return $this->image;
    }

    public function setImage(ObjectStorage $image): void
    {
        $this->image = $image;
    }

    public function addLanguageSkill(LanguageSkill $languageSkill): void
    {
        $this->languageSkill->attach($languageSkill);
    }

    public function removeLanguageSkill(LanguageSkill $languageSkillToRemove): void
    {
        $this->languageSkill->detach($languageSkillToRemove);
    }

    public function getLanguageSkill(): ObjectStorage
    {
        return $this->languageSkill;
    }

    public function setLanguageSkill(ObjectStorage $languageSkill): void
    {
        $this->languageSkill = $languageSkill;
    }

    /**
     * Helper method to build a baseRecord for path_segment
     * Needed in PathSegmentHelper
     *
     * @return array
     */
    public function getBaseRecordForPathSegment(): array
    {
        return [
            'uid' => $this->getUid(),
            'pid' => $this->getPid(),
            'first_name' => $this->getFirstName(),
            'last_name' => $this->getLastName(),
        ];
    }
}
