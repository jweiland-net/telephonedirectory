<?php

/*
 * This file is part of the package jweiland/telephonedirectory.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace JWeiland\Events2\Tests\Unit\Domain\Model;

use JWeiland\Maps2\Domain\Model\PoiCollection;
use JWeiland\Telephonedirectory\Domain\Model\Building;
use Nimut\TestingFramework\TestCase\UnitTestCase;

/**
 * Test case.
 */
class BuildingTest extends UnitTestCase
{
    /**
     * @var Building
     */
    protected $subject;

    /**
     * set up.
     */
    public function setUp()
    {
        $this->subject = new Building();
    }

    /**
     * tear down.
     */
    public function tearDown()
    {
        unset($this->subject);
    }

    /**
     * @test
     */
    public function getTitleInitiallyReturnsEmptyString()
    {
        self::assertSame(
            '',
            $this->subject->getTitle()
        );
    }

    /**
     * @test
     */
    public function setTitleSetsTitle()
    {
        $this->subject->setTitle('foo bar');

        self::assertSame(
            'foo bar',
            $this->subject->getTitle()
        );
    }

    /**
     * @test
     */
    public function setTitleWithIntegerResultsInString()
    {
        $this->subject->setTitle(123);
        self::assertSame('123', $this->subject->getTitle());
    }

    /**
     * @test
     */
    public function setTitleWithBooleanResultsInString()
    {
        $this->subject->setTitle(true);
        self::assertSame('1', $this->subject->getTitle());
    }

    /**
     * @test
     */
    public function getStreetInitiallyReturnsEmptyString()
    {
        self::assertSame(
            '',
            $this->subject->getStreet()
        );
    }

    /**
     * @test
     */
    public function setStreetSetsStreet()
    {
        $this->subject->setStreet('foo bar');

        self::assertSame(
            'foo bar',
            $this->subject->getStreet()
        );
    }

    /**
     * @test
     */
    public function setStreetWithIntegerResultsInString()
    {
        $this->subject->setStreet(123);
        self::assertSame('123', $this->subject->getStreet());
    }

    /**
     * @test
     */
    public function setStreetWithBooleanResultsInString()
    {
        $this->subject->setStreet(true);
        self::assertSame('1', $this->subject->getStreet());
    }

    /**
     * @test
     */
    public function getHouseNumberInitiallyReturnsEmptyString()
    {
        self::assertSame(
            '',
            $this->subject->getHouseNumber()
        );
    }

    /**
     * @test
     */
    public function setHouseNumberSetsHouseNumber()
    {
        $this->subject->setHouseNumber('foo bar');

        self::assertSame(
            'foo bar',
            $this->subject->getHouseNumber()
        );
    }

    /**
     * @test
     */
    public function setHouseNumberWithIntegerResultsInString()
    {
        $this->subject->setHouseNumber(123);
        self::assertSame('123', $this->subject->getHouseNumber());
    }

    /**
     * @test
     */
    public function setHouseNumberWithBooleanResultsInString()
    {
        $this->subject->setHouseNumber(true);
        self::assertSame('1', $this->subject->getHouseNumber());
    }

    /**
     * @test
     */
    public function getZipInitiallyReturnsEmptyString()
    {
        self::assertSame(
            '',
            $this->subject->getZip()
        );
    }

    /**
     * @test
     */
    public function setZipSetsZip()
    {
        $this->subject->setZip('foo bar');

        self::assertSame(
            'foo bar',
            $this->subject->getZip()
        );
    }

    /**
     * @test
     */
    public function setZipWithIntegerResultsInString()
    {
        $this->subject->setZip(123);
        self::assertSame('123', $this->subject->getZip());
    }

    /**
     * @test
     */
    public function setZipWithBooleanResultsInString()
    {
        $this->subject->setZip(true);
        self::assertSame('1', $this->subject->getZip());
    }

    /**
     * @test
     */
    public function getCityInitiallyReturnsEmptyString()
    {
        self::assertSame(
            '',
            $this->subject->getCity()
        );
    }

    /**
     * @test
     */
    public function setCitySetsCity()
    {
        $this->subject->setCity('foo bar');

        self::assertSame(
            'foo bar',
            $this->subject->getCity()
        );
    }

    /**
     * @test
     */
    public function setCityWithIntegerResultsInString()
    {
        $this->subject->setCity(123);
        self::assertSame('123', $this->subject->getCity());
    }

    /**
     * @test
     */
    public function setCityWithBooleanResultsInString()
    {
        $this->subject->setCity(true);
        self::assertSame('1', $this->subject->getCity());
    }

    /**
     * @test
     */
    public function getTxMaps2UidInitiallyReturnsNull()
    {
        self::assertNull($this->subject->getTxMaps2Uid());
    }

    /**
     * @test
     */
    public function setTxMaps2UidSetsTxMaps2Uid()
    {
        $instance = new PoiCollection();
        $this->subject->setTxMaps2Uid($instance);

        self::assertSame(
            $instance,
            $this->subject->getTxMaps2Uid()
        );
    }
}
