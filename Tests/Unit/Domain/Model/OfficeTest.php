<?php

/*
 * This file is part of the package jweiland/telephonedirectory.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace JWeiland\Events2\Tests\Unit\Domain\Model;

use JWeiland\Telephonedirectory\Domain\Model\Department;
use JWeiland\Telephonedirectory\Domain\Model\Office;
use JWeiland\Telephonedirectory\Domain\Model\SubjectField;
use Nimut\TestingFramework\TestCase\UnitTestCase;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

/**
 * Test case.
 */
class OfficeTest extends UnitTestCase
{
    /**
     * @var Office
     */
    protected $subject;

    /**
     * set up.
     */
    public function setUp()
    {
        $this->subject = new Office();
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
    public function getCodeInitiallyReturnsEmptyString()
    {
        self::assertSame(
            '',
            $this->subject->getCode()
        );
    }

    /**
     * @test
     */
    public function setCodeSetsCode()
    {
        $this->subject->setCode('foo bar');

        self::assertSame(
            'foo bar',
            $this->subject->getCode()
        );
    }

    /**
     * @test
     */
    public function setCodeWithIntegerResultsInString()
    {
        $this->subject->setCode(123);
        self::assertSame('123', $this->subject->getCode());
    }

    /**
     * @test
     */
    public function setCodeWithBooleanResultsInString()
    {
        $this->subject->setCode(true);
        self::assertSame('1', $this->subject->getCode());
    }

    /**
     * @test
     */
    public function getTokenInitiallyReturnsEmptyString()
    {
        self::assertSame(
            '',
            $this->subject->getToken()
        );
    }

    /**
     * @test
     */
    public function setTokenSetsToken()
    {
        $this->subject->setToken('foo bar');

        self::assertSame(
            'foo bar',
            $this->subject->getToken()
        );
    }

    /**
     * @test
     */
    public function setTokenWithIntegerResultsInString()
    {
        $this->subject->setToken(123);
        self::assertSame('123', $this->subject->getToken());
    }

    /**
     * @test
     */
    public function setTokenWithBooleanResultsInString()
    {
        $this->subject->setToken(true);
        self::assertSame('1', $this->subject->getToken());
    }

    /**
     * @test
     */
    public function getDepartmentInitiallyReturnsNull()
    {
        self::assertNull($this->subject->getDepartment());
    }

    /**
     * @test
     */
    public function setDepartmentSetsDepartment()
    {
        $instance = new Department();
        $this->subject->setDepartment($instance);

        self::assertSame(
            $instance,
            $this->subject->getDepartment()
        );
    }

    /**
     * @test
     */
    public function setDepartmentsSetsDepartments()
    {
        $departments = new ObjectStorage();
        $departments->attach(new Department());
        $departments->attach(new Department());

        $this->subject->setDepartments($departments);

        self::assertNotCount(0, $this->subject->getDepartments());
    }

    /**
     * @test
     */
    public function addDeparmentAddsDeparment()
    {
        $this->subject->addDepartment(new Department());
        self::assertNotCount(0, $this->subject->getDepartments());
    }

    /**
     * @test
     */
    public function getSubjectFieldInitiallyReturnsNull()
    {
        self::assertNull($this->subject->getSubjectField());
    }

    /**
     * @test
     */
    public function setSubjectFieldSetsSubjectField()
    {
        $instance = new SubjectField();
        $this->subject->setSubjectField($instance);

        self::assertSame(
            $instance,
            $this->subject->getSubjectField()
        );
    }

    /**
     * @test
     */
    public function setSubjectFieldsSetsSubjectFields()
    {
        $subjectFields = new ObjectStorage();
        $subjectFields->attach(new SubjectField());
        $subjectFields->attach(new SubjectField());

        $this->subject->setSubjectFields($subjectFields);

        self::assertNotCount(0, $this->subject->getSubjectFields());
    }

    /**
     * @test
     */
    public function addSubjectFieldAddsSubjectField()
    {
        $this->subject->addSubjectField(new SubjectField());
        self::assertNotCount(0, $this->subject->getSubjectFields());
    }
}
