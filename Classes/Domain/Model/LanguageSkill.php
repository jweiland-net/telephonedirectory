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
 * Class LanguageSkill
 *
 * @package JWeiland\Telephonedirectory\Domain\Model
 */
class LanguageSkill extends AbstractEntity
{
    /**
     * Language
     *
     * @var string
     */
    protected $language = '';

    /**
     * writing
     *
     * @var string
     */
    protected $writing = '';

    /**
     * speaking
     *
     * @var string
     */
    protected $speaking = '';

    /**
     * Infotext
     *
     * @var string
     */
    protected $infotext = '';

    /**
     * Employee
     *
     * @var \JWeiland\Telephonedirectory\Domain\Model\Employee
     */
    protected $employee;

    /**
     * Returns the language
     *
     * @return string
     */
    public function getLanguage(): string
    {
        return $this->language;
    }

    /**
     * Sets the language
     *
     * @param string $language
     * @return void
     */
    public function setLanguage(string $language)
    {
        $this->language = $language;
    }

    /**
     * Returns writing
     *
     * @return string
     */
    public function getWriting(): string
    {
        return $this->writing;
    }

    /**
     * Sets writing
     *
     * @param string $writing
     * @return void
     */
    public function setWriting(string $writing)
    {
        $this->writing = $writing;
    }

    /**
     * Returns speaking
     *
     * @return string
     */
    public function getSpeaking(): string
    {
        return $this->speaking;
    }

    /**
     * Sets speaking
     *
     * @param string $speaking
     * @return void
     */
    public function setSpeaking(string $speaking)
    {
        $this->speaking = $speaking;
    }

    /**
     * Returns the infotext
     *
     * @return string
     */
    public function getInfotext(): string
    {
        return $this->infotext;
    }

    /**
     * Sets the infotext
     *
     * @param string $infotext
     * @return void
     */
    public function setInfotext(string $infotext)
    {
        $this->infotext = $infotext;
    }

    /**
     * Returns the employee
     *
     * @return Employee $employee
     */
    public function getEmployee()
    {
        return $this->employee;
    }

    /**
     * Sets the employee
     *
     * @param Employee $employee
     * @return void
     */
    public function setEmployee($employee)
    {
        $this->employee = $employee;
    }
}
