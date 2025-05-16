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
use PHPUnit\Framework\Attributes\Test;
use TYPO3\TestingFramework\Core\Unit\UnitTestCase;

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

    #[Test]
    public function getLanguageInitiallyReturnsNull(): void
    {
        self::assertNull($this->subject->getLanguage());
    }

    #[Test]
    public function setLanguageSetsLanguage(): void
    {
        $instance = new Language();
        $this->subject->setLanguage($instance);

        self::assertSame(
            $instance,
            $this->subject->getLanguage(),
        );
    }

    #[Test]
    public function getWritingInitiallyReturnsEmptyString(): void
    {
        self::assertSame(
            '',
            $this->subject->getWriting(),
        );
    }

    #[Test]
    public function setWritingSetsWriting(): void
    {
        $this->subject->setWriting('foo bar');

        self::assertSame(
            'foo bar',
            $this->subject->getWriting(),
        );
    }

    #[Test]
    public function getSpeakingInitiallyReturnsEmptyString(): void
    {
        self::assertSame(
            '',
            $this->subject->getSpeaking(),
        );
    }

    #[Test]
    public function setSpeakingSetsSpeaking(): void
    {
        $this->subject->setSpeaking('foo bar');

        self::assertSame(
            'foo bar',
            $this->subject->getSpeaking(),
        );
    }

    #[Test]
    public function getInfotextInitiallyReturnsEmptyString(): void
    {
        self::assertSame(
            '',
            $this->subject->getInfotext(),
        );
    }

    #[Test]
    public function setInfotextSetsInfotext(): void
    {
        $this->subject->setInfotext('foo bar');

        self::assertSame(
            'foo bar',
            $this->subject->getInfotext(),
        );
    }

    #[Test]
    public function getEmployeeInitiallyReturnsNull(): void
    {
        self::assertNull($this->subject->getEmployee());
    }

    #[Test]
    public function setEmployeeSetsEmployee(): void
    {
        $instance = new Employee();
        $this->subject->setEmployee($instance);

        self::assertSame(
            $instance,
            $this->subject->getEmployee(),
        );
    }
}
