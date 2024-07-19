<?php

declare(strict_types=1);

/*
 * This file is part of the package jweiland/telephonedirectory.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace JWeiland\Telephonedirectory\Domain\Model;

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
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\JWeiland\Telephonedirectory\Domain\Model\Category>
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
     * @TYPO3\CMS\Extbase\Annotation\Validate("EmailAddress")
     */
    protected string $email = '';

    protected string $additionalInformations = '';

    protected string $regularAttendance = '';

    protected bool $moduleSysDmailHtml = true;

    protected ?Office $office = null;

    protected ?Building $building = null;

    protected ?Department $department = null;

    /**
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference>
     */
    protected ObjectStorage $image;

    /**
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\JWeiland\Telephonedirectory\Domain\Model\LanguageSkill>
     * @TYPO3\CMS\Extbase\Annotation\ORM\Lazy
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

    public function setHidden(bool $hidden): self
    {
        $this->hidden = $hidden;
        return $this;
    }

    public function getTitle(): int
    {
        return $this->title;
    }

    public function setTitle(int $title): self
    {
        $this->title = $title;
        return $this;
    }

    public function getPathSegment(): string
    {
        return $this->pathSegment;
    }

    public function setPathSegment(string $pathSegment): self
    {
        $this->pathSegment = $pathSegment;
        return $this;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;
        return $this;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;
        return $this;
    }

    public function getNameAdditions(): string
    {
        return $this->nameAdditions;
    }

    public function setNameAdditions(string $nameAdditions): self
    {
        $this->nameAdditions = $nameAdditions;
        return $this;
    }

    public function getIsCatchAllMail(): bool
    {
        return $this->isCatchAllMail;
    }

    public function setIsCatchAllMail(bool $isCatchAllMail): self
    {
        $this->isCatchAllMail = $isCatchAllMail;
        return $this;
    }

    public function getSubjectField(): ?SubjectField
    {
        return $this->subjectField ?: null;
    }

    public function setSubjectField(?SubjectField $subjectField): self
    {
        $this->subjectField = $subjectField ?: 0;
        return $this;
    }

    public function getCompany(): string
    {
        return $this->company;
    }

    public function setCompany(string $company): self
    {
        $this->company = $company;
        return $this;
    }

    public function getRoomNumber(): string
    {
        return $this->roomNumber;
    }

    public function setRoomNumber(string $roomNumber): self
    {
        $this->roomNumber = $roomNumber;
        return $this;
    }

    public function getFunction(): string
    {
        return $this->function;
    }

    public function setFunction(string $function): self
    {
        $this->function = $function;
        return $this;
    }

    public function getAdditionalFunction(): ObjectStorage
    {
        return $this->additionalFunction;
    }

    public function setAdditionalFunction(ObjectStorage $additionalFunction): self
    {
        $this->additionalFunction = $additionalFunction;
        return $this;
    }

    public function addAdditionalFunction(Category $additionalFunction): self
    {
        $this->additionalFunction->attach($additionalFunction);
        return $this;
    }

    public function removeAdditionalFunction(Category $additionalFunction): self
    {
        $this->additionalFunction->detach($additionalFunction);
        return $this;
    }

    public function getTelephone1(): string
    {
        return $this->telephone1;
    }

    public function setTelephone1(string $telephone1): self
    {
        $this->telephone1 = $telephone1;
        return $this;
    }

    public function getTelephone2(): string
    {
        return $this->telephone2;
    }

    public function setTelephone2(string $telephone2): self
    {
        $this->telephone2 = $telephone2;
        return $this;
    }

    public function getTelephone3(): string
    {
        return $this->telephone3;
    }

    public function setTelephone3(string $telephone3): self
    {
        $this->telephone3 = $telephone3;
        return $this;
    }

    public function getMobile(): string
    {
        return $this->mobile;
    }

    public function setMobile(string $mobile): self
    {
        $this->mobile = $mobile;
        return $this;
    }

    public function getPager(): string
    {
        return $this->pager;
    }

    public function setPager(string $pager): self
    {
        $this->pager = $pager;
        return $this;
    }

    public function getFax(): string
    {
        return $this->fax;
    }

    public function setFax(string $fax): self
    {
        $this->fax = $fax;
        return $this;
    }

    public function getPcFax(): string
    {
        return $this->pcFax;
    }

    public function setPcFax(string $pcFax): self
    {
        $this->pcFax = $pcFax;
        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }

    public function getAdditionalInformations(): string
    {
        return $this->additionalInformations;
    }

    public function setAdditionalInformations(string $additionalInformations): self
    {
        $this->additionalInformations = $additionalInformations;
        return $this;
    }

    public function getRegularAttendance(): string
    {
        return $this->regularAttendance;
    }

    public function setRegularAttendance(string $regularAttendance): self
    {
        $this->regularAttendance = $regularAttendance;
        return $this;
    }

    public function getModuleSysDmailHtml(): bool
    {
        return $this->moduleSysDmailHtml;
    }

    public function setModuleSysDmailHtml(bool $moduleSysDmailHtml): self
    {
        $this->moduleSysDmailHtml = $moduleSysDmailHtml;
        return $this;
    }

    public function getOffice(): ?Office
    {
        return $this->office ?: null;
    }

    public function setOffice(Office $office = null): self
    {
        $this->office = $office ?: 0;
        return $this;
    }

    public function getBuilding(): ?Building
    {
        return $this->building ?: null;
    }

    public function setBuilding(Building $building): self
    {
        $this->building = $building ?: 0;
        return $this;
    }

    public function getDepartment(): ?Department
    {
        return $this->department ?: null;
    }

    public function setDepartment(?Department $department): self
    {
        $this->department = $department ?: 0;
        return $this;
    }

    public function getFirstImage(): ?FileReference
    {
        $this->image->rewind();
        return $this->image->current() ?: null;
    }

    public function getImage(): ObjectStorage
    {
        return $this->image;
    }

    public function setImage(ObjectStorage $image): self
    {
        $this->image = $image;
        return $this;
    }

    public function addLanguageSkill(LanguageSkill $languageSkill): self
    {
        $this->languageSkill->attach($languageSkill);
        return $this;
    }

    public function removeLanguageSkill(LanguageSkill $languageSkillToRemove): self
    {
        $this->languageSkill->detach($languageSkillToRemove);
        return $this;
    }

    public function getLanguageSkill(): ObjectStorage
    {
        return $this->languageSkill;
    }

    public function setLanguageSkill(ObjectStorage $languageSkill): self
    {
        $this->languageSkill = $languageSkill;
        return $this;
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
            'last_name' => $this->getLastName()
        ];
    }
}
