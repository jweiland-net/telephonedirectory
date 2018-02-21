<?php
declare(strict_types=1);
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
 * Class Office
 *
 * @package JWeiland\Telephonedirectory\Domain\Model
 */
class Office extends AbstractEntity
{
    /**
     * Title
     *
     * @var string
     */
    protected $title = '';

    /**
     * Code
     *
     * @var string
     */
    protected $code = '';

    /**
     * Token
     *
     * @var string
     */
    protected $token = '';

    /**
     * Department
     *
     * @var \JWeiland\Telephonedirectory\Domain\Model\Department
     */
    protected $department;

    /**
     * Subject field
     *
     * @var \JWeiland\Telephonedirectory\Domain\Model\SubjectField
     */
    protected $subjectField;

    /**
     * Returns the title
     *
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * Sets the title
     *
     * @param string $title
     * @return void
     */
    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    /**
     * Gets code
     *
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * Sets code
     *
     * @param string $code
     */
    public function setCode(string $code)
    {
        $this->code = $code;
    }

    /**
     * Gets token
     *
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * Sets token
     *
     * @param string $token
     */
    public function setToken(string $token)
    {
        $this->token = $token;
    }

    /**
     * Gets department
     *
     * @return Department
     */
    public function getDepartment()
    {
        return $this->department;
    }

    /**
     * Sets department
     *
     * @param Department $department
     */
    public function setDepartment(Department $department)
    {
        $this->department = $department;
    }

    /**
     * Gets subject field
     *
     * @return SubjectField
     */
    public function getSubjectField()
    {
        return $this->subjectField;
    }

    /**
     * Sets subject field
     *
     * @param SubjectField $subjectField
     */
    public function setSubjectField(SubjectField $subjectField)
    {
        $this->subjectField = $subjectField;
    }
}
