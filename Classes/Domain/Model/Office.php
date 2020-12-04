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
     * @var \JWeiland\Telephonedirectory\Domain\Model\Department
     */
    protected $department;

    /**
     * @var \JWeiland\Telephonedirectory\Domain\Model\SubjectField
     */
    protected $subjectField;

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

    public function getDepartment(): ?Department
    {
        return $this->department;
    }

    public function setDepartment(Department $department): self
    {
        $this->department = $department;
        return $this;
    }

    public function getSubjectField(): ?SubjectField
    {
        return $this->subjectField;
    }

    public function setSubjectField(SubjectField $subjectField): self
    {
        $this->subjectField = $subjectField;
        return $this;
    }
}
