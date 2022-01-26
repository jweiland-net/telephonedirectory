<?php

declare(strict_types=1);

/*
 * This file is part of the package jweiland/telephonedirectory.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace JWeiland\Telephonedirectory\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

/**
 * Class which contains all setters and getters for Office
 */
class Office extends AbstractEntity
{
    /**
     * @var string
     */
    protected $title = '';

    /**
     * @var string
     */
    protected $code = '';

    /**
     * @var string
     */
    protected $token = '';

    /**
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\JWeiland\Telephonedirectory\Domain\Model\Department>
     */
    protected $departments;

    /**
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\JWeiland\Telephonedirectory\Domain\Model\SubjectField>
     */
    protected $subjectFields;

    public function __construct()
    {
        $this->departments = new ObjectStorage();
        $this->subjectFields = new ObjectStorage();
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;
        return $this;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;
        return $this;
    }

    public function getToken(): string
    {
        return $this->token;
    }

    public function setToken(string $token): self
    {
        $this->token = $token;
        return $this;
    }

    public function getSubjectField(): ?SubjectField
    {
        return $this->subjectFields[0];
    }

    /**
     * @deprecated Either use addSubjectField or setSubjectFields
     */
    public function setSubjectField(SubjectField $subjectField): self
    {
        return $this->addSubjectField($subjectField);
    }

    public function addSubjectField(SubjectField $subjectField): self
    {
        if (!$this->subjectFields->contains($subjectField)) {
            $this->subjectFields->attach($subjectField);
        }

        return $this;
    }

    public function getSubjectFields(): ObjectStorage
    {
        return $this->subjectFields;
    }

    public function setSubjectFields(ObjectStorage $subjectFields): self
    {
        $this->subjectFields = $subjectFields;
        return $this;
    }

    public function getDepartment(): ?Department
    {
        return $this->departments[0];
    }

    /**
     * @deprecated Either use addDepartment or setDepartments
     */
    public function setDepartment(Department $department): self
    {
        return $this->addDepartment($department);
    }

    public function addDepartment(Department $department): self
    {
        if (!$this->departments->contains($department)) {
            $this->departments->attach($department);
        }

        return $this;
    }

    public function getDepartments(): ObjectStorage
    {
        return $this->departments;
    }

    public function setDepartments(ObjectStorage $departments): self
    {
        $this->departments = $departments;
        return $this;
    }
}
