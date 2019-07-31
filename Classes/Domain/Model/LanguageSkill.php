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
 * Class which contains all setters and getters for LanguageSkill
 */
class LanguageSkill extends AbstractEntity
{
    /**
     * @var \JWeiland\Telephonedirectory\Domain\Model\Language
     */
    protected $language;

    /**
     * @var string
     */
    protected $writing = '';

    /**
     * @var string
     */
    protected $speaking = '';

    /**
     * @var string
     */
    protected $infotext = '';

    /**
     * @var \JWeiland\Telephonedirectory\Domain\Model\Employee
     */
    protected $employee;

    /**
     * @return Language|null
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @param Language|null $language
     */
    public function setLanguage(Language $language = null)
    {
        $this->language = $language;
    }

    /**
     * @return string
     */
    public function getWriting(): string
    {
        return $this->writing;
    }

    /**
     * @param string $writing
     */
    public function setWriting(string $writing)
    {
        $this->writing = $writing;
    }

    /**
     * @return string
     */
    public function getSpeaking(): string
    {
        return $this->speaking;
    }

    /**
     * @param string $speaking
     */
    public function setSpeaking(string $speaking)
    {
        $this->speaking = $speaking;
    }

    /**
     * @return string
     */
    public function getInfotext(): string
    {
        return $this->infotext;
    }

    /**
     * @param string $infotext
     */
    public function setInfotext(string $infotext)
    {
        $this->infotext = $infotext;
    }

    /**
     * @return Employee|null $employee
     */
    public function getEmployee()
    {
        return $this->employee;
    }

    /**
     * @param Employee|null $employee
     */
    public function setEmployee($employee = null)
    {
        $this->employee = $employee;
    }
}
