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
    protected string $title = '';

    protected string $code = '';

    protected string $token = '';

    /**
     * @var ObjectStorage<Department>
     */
    protected ObjectStorage $departments;

    /**
     * @var ObjectStorage<SubjectField>
     */
    protected ObjectStorage $subjectFields;

    public function __construct()
    {
        $this->departments = new ObjectStorage();
        $this->subjectFields = new ObjectStorage();
    }

    /**
     * Called again with initialize object, as fetching an entity from the DB does not use the constructor
     */
    public function initializeObject(): void
    {
        $this->departments = $this->departments ?? new ObjectStorage();
        $this->subjectFields = $this->subjectFields ?? new ObjectStorage();
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function setCode(string $code): void
    {
        $this->code = $code;
    }

    public function getToken(): string
    {
        return $this->token;
    }

    public function setToken(string $token): void
    {
        $this->token = $token;
    }

    public function getSubjectField(): ?SubjectField
    {
        if ($this->subjectFields->count() > 0) {
            return $this->subjectFields->current(); // Gets the first element
        }

        return null;
    }

    /**
     * @deprecated Either use addSubjectField or setSubjectFields
     */
    public function setSubjectField(SubjectField $subjectField): void
    {
        $this->addSubjectField($subjectField);
    }

    public function addSubjectField(SubjectField $subjectField): void
    {
        if (!$this->subjectFields->contains($subjectField)) {
            $this->subjectFields->attach($subjectField);
        }
    }

    /**
     * @return ObjectStorage<SubjectField>
     */
    public function getSubjectFields(): ObjectStorage
    {
        return $this->subjectFields;
    }

    /**
     * @param ObjectStorage<SubjectField> $subjectFields
     */
    public function setSubjectFields(ObjectStorage $subjectFields): void
    {
        $this->subjectFields = $subjectFields;
    }

    public function getDepartment(): ?Department
    {
        if ($this->departments->count() > 0) {
            return $this->departments->current();
        }
        return null;
    }

    /**
     * @deprecated Either use addDepartment or setDepartments
     */
    public function setDepartment(Department $department): void
    {
        $this->addDepartment($department);
    }

    public function addDepartment(Department $department): void
    {
        if (!$this->departments->contains($department)) {
            $this->departments->attach($department);
        }
    }

    /**
     * @return ObjectStorage<Department>
     */
    public function getDepartments(): ObjectStorage
    {
        return $this->departments;
    }

    /**
     * @param ObjectStorage<Department> $departments
     */
    public function setDepartments(ObjectStorage $departments): void
    {
        $this->departments = $departments;
    }
}
