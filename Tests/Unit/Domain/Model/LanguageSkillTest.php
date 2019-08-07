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
        $this->assertNull($this->subject->getLanguage());
    }

    /**
     * @test
     */
    public function setLanguageSetsLanguage()
    {
        $instance = new Language();
        $this->subject->setLanguage($instance);

        $this->assertSame(
            $instance,
            $this->subject->getLanguage()
        );
    }

    /**
     * @test
     */
    public function getWritingInitiallyReturnsEmptyString()
    {
        $this->assertSame(
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

        $this->assertSame(
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
        $this->assertSame('123', $this->subject->getWriting());
    }

    /**
     * @test
     */
    public function setWritingWithBooleanResultsInString()
    {
        $this->subject->setWriting(true);
        $this->assertSame('1', $this->subject->getWriting());
    }

    /**
     * @test
     */
    public function getSpeakingInitiallyReturnsEmptyString()
    {
        $this->assertSame(
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

        $this->assertSame(
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
        $this->assertSame('123', $this->subject->getSpeaking());
    }

    /**
     * @test
     */
    public function setSpeakingWithBooleanResultsInString()
    {
        $this->subject->setSpeaking(true);
        $this->assertSame('1', $this->subject->getSpeaking());
    }

    /**
     * @test
     */
    public function getInfotextInitiallyReturnsEmptyString()
    {
        $this->assertSame(
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

        $this->assertSame(
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
        $this->assertSame('123', $this->subject->getInfotext());
    }

    /**
     * @test
     */
    public function setInfotextWithBooleanResultsInString()
    {
        $this->subject->setInfotext(true);
        $this->assertSame('1', $this->subject->getInfotext());
    }

    /**
     * @test
     */
    public function getEmployeeInitiallyReturnsNull()
    {
        $this->assertNull($this->subject->getEmployee());
    }

    /**
     * @test
     */
    public function setEmployeeSetsEmployee()
    {
        $instance = new Employee();
        $this->subject->setEmployee($instance);

        $this->assertSame(
            $instance,
            $this->subject->getEmployee()
        );
    }
}
