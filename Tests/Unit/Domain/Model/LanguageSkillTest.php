<?php

/*
 * This file is part of the package jweiland/telephonedirectory.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace JWeiland\Events2\Tests\Unit\Domain\Model;

use JWeiland\Telephonedirectory\Domain\Model\Employee;
use JWeiland\Telephonedirectory\Domain\Model\Language;
use JWeiland\Telephonedirectory\Domain\Model\LanguageSkill;
use Nimut\TestingFramework\TestCase\UnitTestCase;

/**
 * Test case.
 */
class LanguageSkillTest extends UnitTestCase
{
    /**
     * @var LanguageSkill
     */
    protected $subject;

    /**
     * set up.
     */
    public function setUp()
    {
        $this->subject = new LanguageSkill();
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
    public function getLanguageInitiallyReturnsNull()
    {
        self::assertNull($this->subject->getLanguage());
    }

    /**
     * @test
     */
    public function setLanguageSetsLanguage()
    {
        $instance = new Language();
        $this->subject->setLanguage($instance);

        self::assertSame(
            $instance,
            $this->subject->getLanguage()
        );
    }

    /**
     * @test
     */
    public function getWritingInitiallyReturnsEmptyString()
    {
        self::assertSame(
            '',
            $this->subject->getWriting()
        );
    }

    /**
     * @test
     */
    public function setWritingSetsWriting()
    {
        $this->subject->setWriting('foo bar');

        self::assertSame(
            'foo bar',
            $this->subject->getWriting()
        );
    }

    /**
     * @test
     */
    public function setWritingWithIntegerResultsInString()
    {
        $this->subject->setWriting(123);
        self::assertSame('123', $this->subject->getWriting());
    }

    /**
     * @test
     */
    public function setWritingWithBooleanResultsInString()
    {
        $this->subject->setWriting(true);
        self::assertSame('1', $this->subject->getWriting());
    }

    /**
     * @test
     */
    public function getSpeakingInitiallyReturnsEmptyString()
    {
        self::assertSame(
            '',
            $this->subject->getSpeaking()
        );
    }

    /**
     * @test
     */
    public function setSpeakingSetsSpeaking()
    {
        $this->subject->setSpeaking('foo bar');

        self::assertSame(
            'foo bar',
            $this->subject->getSpeaking()
        );
    }

    /**
     * @test
     */
    public function setSpeakingWithIntegerResultsInString()
    {
        $this->subject->setSpeaking(123);
        self::assertSame('123', $this->subject->getSpeaking());
    }

    /**
     * @test
     */
    public function setSpeakingWithBooleanResultsInString()
    {
        $this->subject->setSpeaking(true);
        self::assertSame('1', $this->subject->getSpeaking());
    }

    /**
     * @test
     */
    public function getInfotextInitiallyReturnsEmptyString()
    {
        self::assertSame(
            '',
            $this->subject->getInfotext()
        );
    }

    /**
     * @test
     */
    public function setInfotextSetsInfotext()
    {
        $this->subject->setInfotext('foo bar');

        self::assertSame(
            'foo bar',
            $this->subject->getInfotext()
        );
    }

    /**
     * @test
     */
    public function setInfotextWithIntegerResultsInString()
    {
        $this->subject->setInfotext(123);
        self::assertSame('123', $this->subject->getInfotext());
    }

    /**
     * @test
     */
    public function setInfotextWithBooleanResultsInString()
    {
        $this->subject->setInfotext(true);
        self::assertSame('1', $this->subject->getInfotext());
    }

    /**
     * @test
     */
    public function getEmployeeInitiallyReturnsNull()
    {
        self::assertNull($this->subject->getEmployee());
    }

    /**
     * @test
     */
    public function setEmployeeSetsEmployee()
    {
        $instance = new Employee();
        $this->subject->setEmployee($instance);

        self::assertSame(
            $instance,
            $this->subject->getEmployee()
        );
    }
}
