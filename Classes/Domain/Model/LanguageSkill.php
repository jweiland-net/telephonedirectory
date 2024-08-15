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
    protected ?Language $language = null;

    protected string $writing = '';

    protected string $speaking = '';

    protected string $infotext = '';

    protected ?Employee $employee = null;

    public function getLanguage(): ?Language
    {
        return $this->language;
    }

    public function setLanguage(Language $language): void
    {
        $this->language = $language;
    }

    public function getWriting(): string
    {
        return $this->writing;
    }

    public function setWriting(string $writing): void
    {
        $this->writing = $writing;
    }

    public function getSpeaking(): string
    {
        return $this->speaking;
    }

    public function setSpeaking(string $speaking): void
    {
        $this->speaking = $speaking;
    }

    public function getInfotext(): string
    {
        return $this->infotext;
    }

    public function setInfotext(string $infotext): void
    {
        $this->infotext = $infotext;
    }

    public function getEmployee(): ?Employee
    {
        return $this->employee;
    }

    public function setEmployee(Employee $employee): void
    {
        $this->employee = $employee;
    }
}
