<?php

declare(strict_types=1);

/*
 * This file is part of the package jweiland/telephonedirectory.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace JWeiland\Telephonedirectory\Tests\Unit\Domain\Model;

use JWeiland\Telephonedirectory\Domain\Model\Department;
use JWeiland\Telephonedirectory\Domain\Model\Office;
use JWeiland\Telephonedirectory\Domain\Model\SubjectField;
use PHPUnit\Framework\Attributes\Test;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;
use TYPO3\TestingFramework\Core\Unit\UnitTestCase;

/**
 * Test case.
 */
class OfficeTest extends UnitTestCase
{
    /**
     * @var Office
     */
    protected $subject;

    protected function setUp(): void
    {
        $this->subject = new Office();
    }

    protected function tearDown(): void
    {
        unset($this->subject);
    }

    #[Test]
    public function getTitleInitiallyReturnsEmptyString(): void
    {
        self::assertSame(
            '',
            $this->subject->getTitle(),
        );
    }

    #[Test]
    public function setTitleSetsTitle(): void
    {
        $this->subject->setTitle('foo bar');

        self::assertSame(
            'foo bar',
            $this->subject->getTitle(),
        );
    }

    #[Test]
    public function getCodeInitiallyReturnsEmptyString(): void
    {
        self::assertSame(
            '',
            $this->subject->getCode(),
        );
    }

    #[Test]
    public function setCodeSetsCode(): void
    {
        $this->subject->setCode('foo bar');

        self::assertSame(
            'foo bar',
            $this->subject->getCode(),
        );
    }

    #[Test]
    public function getTokenInitiallyReturnsEmptyString(): void
    {
        self::assertSame(
            '',
            $this->subject->getToken(),
        );
    }

    #[Test]
    public function setTokenSetsToken(): void
    {
        $this->subject->setToken('foo bar');

        self::assertSame(
            'foo bar',
            $this->subject->getToken(),
        );
    }

    #[Test]
    public function getDepartmentInitiallyReturnsNull(): void
    {
        self::assertNull($this->subject->getDepartment());
    }

    #[Test]
    public function setDepartmentSetsDepartment(): void
    {
        $instance = new Department();
        $this->subject->setDepartment($instance);

        self::assertSame(
            $instance,
            $this->subject->getDepartment(),
        );
    }

    #[Test]
    public function setDepartmentsSetsDepartments(): void
    {
        $departments = new ObjectStorage();
        $departments->attach(new Department());
        $departments->attach(new Department());

        $this->subject->setDepartments($departments);

        self::assertNotCount(0, $this->subject->getDepartments());
    }

    #[Test]
    public function addDeparmentAddsDeparment(): void
    {
        $this->subject->addDepartment(new Department());
        self::assertNotCount(0, $this->subject->getDepartments());
    }

    #[Test]
    public function getSubjectFieldInitiallyReturnsNull(): void
    {
        self::assertNull($this->subject->getSubjectField());
    }

    #[Test]
    public function setSubjectFieldSetsSubjectField(): void
    {
        $instance = new SubjectField();
        $this->subject->setSubjectField($instance);

        self::assertSame(
            $instance,
            $this->subject->getSubjectField(),
        );
    }

    #[Test]
    public function setSubjectFieldsSetsSubjectFields(): void
    {
        $subjectFields = new ObjectStorage();
        $subjectFields->attach(new SubjectField());
        $subjectFields->attach(new SubjectField());

        $this->subject->setSubjectFields($subjectFields);

        self::assertNotCount(0, $this->subject->getSubjectFields());
    }

    #[Test]
    public function addSubjectFieldAddsSubjectField(): void
    {
        $this->subject->addSubjectField(new SubjectField());
        self::assertNotCount(0, $this->subject->getSubjectFields());
    }
}
