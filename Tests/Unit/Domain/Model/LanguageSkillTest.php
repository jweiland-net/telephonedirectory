<?php

declare(strict_types=1);

/*
 * This file is part of the package jweiland/telephonedirectory.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace JWeiland\Telephonedirectory\Tests\Unit\Domain\Model;

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

    protected function setUp(): void
    {
        $this->subject = new LanguageSkill();
    }

    protected function tearDown(): void
    {
        unset($this->subject);
    }

    /**
     * @test
     */
    public function getLanguageInitiallyReturnsNull(): void
    {
        self::assertNull($this->subject->getLanguage());
    }

    /**
     * @test
     */
    public function setLanguageSetsLanguage(): void
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
    public function getWritingInitiallyReturnsEmptyString(): void
    {
        self::assertSame(
            '',
            $this->subject->getWriting()
        );
    }

    /**
     * @test
     */
    public function setWritingSetsWriting(): void
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
    public function getSpeakingInitiallyReturnsEmptyString(): void
    {
        self::assertSame(
            '',
            $this->subject->getSpeaking()
        );
    }

    /**
     * @test
     */
    public function setSpeakingSetsSpeaking(): void
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
    public function getInfotextInitiallyReturnsEmptyString(): void
    {
        self::assertSame(
            '',
            $this->subject->getInfotext()
        );
    }

    /**
     * @test
     */
    public function setInfotextSetsInfotext(): void
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
    public function getEmployeeInitiallyReturnsNull(): void
    {
        self::assertNull($this->subject->getEmployee());
    }

    /**
     * @test
     */
    public function setEmployeeSetsEmployee(): void
    {
        $instance = new Employee();
        $this->subject->setEmployee($instance);

        self::assertSame(
            $instance,
            $this->subject->getEmployee()
        );
    }
}
