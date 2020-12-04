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

    public function getLanguage(): ?Language
    {
        return $this->language;
    }

    public function setLanguage(Language $language): self
    {
        $this->language = $language;
        return $this;
    }

    public function getWriting(): string
    {
        return $this->writing;
    }

    public function setWriting(string $writing): self
    {
        $this->writing = $writing;
        return $this;
    }

    public function getSpeaking(): string
    {
        return $this->speaking;
    }

    public function setSpeaking(string $speaking): self
    {
        $this->speaking = $speaking;
        return $this;
    }

    public function getInfotext(): string
    {
        return $this->infotext;
    }

    public function setInfotext(string $infotext): self
    {
        $this->infotext = $infotext;
        return $this;
    }

    public function getEmployee(): ?Employee
    {
        return $this->employee;
    }

    public function setEmployee(Employee $employee): self
    {
        $this->employee = $employee;
        return $this;
    }
}
