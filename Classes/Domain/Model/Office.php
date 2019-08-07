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

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @param string $code
     */
    public function setCode(string $code)
    {
        $this->code = $code;
    }

    /**
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * @param string $token
     */
    public function setToken(string $token)
    {
        $this->token = $token;
    }

    /**
     * @return Department|null
     */
    public function getDepartment()
    {
        return $this->department;
    }

    /**
     * @param Department|null $department
     */
    public function setDepartment(Department $department)
    {
        $this->department = $department;
    }

    /**
     * @return SubjectField|null
     */
    public function getSubjectField()
    {
        return $this->subjectField;
    }

    /**
     * @param SubjectField|null $subjectField
     */
    public function setSubjectField(SubjectField $subjectField = null)
    {
        $this->subjectField = $subjectField;
    }
}
