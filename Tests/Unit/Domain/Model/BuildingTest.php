<?php
namespace JWeiland\Events2\Tests\Unit\Domain\Model;

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
        $this->assertSame(
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

        $this->assertSame(
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
        $this->assertSame('123', $this->subject->getTitle());
    }

    /**
     * @test
     */
    public function setTitleWithBooleanResultsInString()
    {
        $this->subject->setTitle(TRUE);
        $this->assertSame('1', $this->subject->getTitle());
    }

    /**
     * @test
     */
    public function getStreetInitiallyReturnsEmptyString()
    {
        $this->assertSame(
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

        $this->assertSame(
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
        $this->assertSame('123', $this->subject->getStreet());
    }

    /**
     * @test
     */
    public function setStreetWithBooleanResultsInString()
    {
        $this->subject->setStreet(TRUE);
        $this->assertSame('1', $this->subject->getStreet());
    }

    /**
     * @test
     */
    public function getHouseNumberInitiallyReturnsEmptyString()
    {
        $this->assertSame(
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

        $this->assertSame(
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
        $this->assertSame('123', $this->subject->getHouseNumber());
    }

    /**
     * @test
     */
    public function setHouseNumberWithBooleanResultsInString()
    {
        $this->subject->setHouseNumber(TRUE);
        $this->assertSame('1', $this->subject->getHouseNumber());
    }

    /**
     * @test
     */
    public function getZipInitiallyReturnsEmptyString()
    {
        $this->assertSame(
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

        $this->assertSame(
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
        $this->assertSame('123', $this->subject->getZip());
    }

    /**
     * @test
     */
    public function setZipWithBooleanResultsInString()
    {
        $this->subject->setZip(TRUE);
        $this->assertSame('1', $this->subject->getZip());
    }

    /**
     * @test
     */
    public function getCityInitiallyReturnsEmptyString()
    {
        $this->assertSame(
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

        $this->assertSame(
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
        $this->assertSame('123', $this->subject->getCity());
    }

    /**
     * @test
     */
    public function setCityWithBooleanResultsInString()
    {
        $this->subject->setCity(TRUE);
        $this->assertSame('1', $this->subject->getCity());
    }

    /**
     * @test
     */
    public function getTxMaps2UidInitiallyReturnsNull()
    {
        $this->assertNull($this->subject->getTxMaps2Uid());
    }

    /**
     * @test
     */
    public function setTxMaps2UidSetsTxMaps2Uid()
    {
        $instance = new PoiCollection();
        $this->subject->setTxMaps2Uid($instance);

        $this->assertSame(
            $instance,
            $this->subject->getTxMaps2Uid()
        );
    }
}
