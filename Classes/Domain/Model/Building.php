<?php

declare(strict_types=1);

/*
 * This file is part of the package jweiland/telephonedirectory.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace JWeiland\Telephonedirectory\Domain\Model;

use JWeiland\Maps2\Domain\Model\PoiCollection;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;

/**
 * Class which contains all setters and getters for Building
 */
class Building extends AbstractEntity
{
    /**
     * @var string
     */
    protected $title = '';

    /**
     * @var string
     */
    protected $street = '';

    /**
     * @var string
     */
    protected $houseNumber = '';

    /**
     * @var string
     */
    protected $zip = '';

    /**
     * @var string
     */
    protected $city = '';

    /**
     * @var \JWeiland\Maps2\Domain\Model\PoiCollection
     */
    protected $txMaps2Uid;

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;
        return $this;
    }

    public function getStreet(): string
    {
        return $this->street;
    }

    public function setStreet(string $street): self
    {
        $this->street = $street;
        return $this;
    }

    public function getHouseNumber(): string
    {
        return $this->houseNumber;
    }

    public function setHouseNumber(string $houseNumber): self
    {
        $this->houseNumber = $houseNumber;
        return $this;
    }

    public function getZip(): string
    {
        return $this->zip;
    }

    public function setZip(string $zip): self
    {
        $this->zip = $zip;
        return $this;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;
        return $this;
    }

    public function getTxMaps2Uid(): ?PoiCollection
    {
        return $this->txMaps2Uid;
    }

    public function setTxMaps2Uid(PoiCollection $txMaps2Uid): self
    {
        $this->txMaps2Uid = $txMaps2Uid;
        return $this;
    }
}
