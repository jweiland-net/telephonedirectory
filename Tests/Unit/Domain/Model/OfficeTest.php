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

use JWeiland\Telephonedirectory\Domain\Model\Department;
use JWeiland\Telephonedirectory\Domain\Model\Office;
use JWeiland\Telephonedirectory\Domain\Model\SubjectField;
use Nimut\TestingFramework\TestCase\UnitTestCase;

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
    public function getTitleInitiallyReturnsEmptyString() {
        $this->assertSame(
            '',
            $this->subject->getTitle()
        );
    }

    /**
     * @test
     */
    public function setTitleSetsTitle() {
        $this->subject->setTitle('foo bar');

        $this->assertSame(
            'foo bar',
            $this->subject->getTitle()
        );
    }

    /**
     * @test
     */
    public function setTitleWithIntegerResultsInString() {
        $this->subject->setTitle(123);
        $this->assertSame('123', $this->subject->getTitle());
    }

    /**
     * @test
     */
    public function setTitleWithBooleanResultsInString() {
        $this->subject->setTitle(TRUE);
        $this->assertSame('1', $this->subject->getTitle());
    }

    /**
     * @test
     */
    public function getCodeInitiallyReturnsEmptyString() {
        $this->assertSame(
            '',
            $this->subject->getCode()
        );
    }

    /**
     * @test
     */
    public function setCodeSetsCode() {
        $this->subject->setCode('foo bar');

        $this->assertSame(
            'foo bar',
            $this->subject->getCode()
        );
    }

    /**
     * @test
     */
    public function setCodeWithIntegerResultsInString() {
        $this->subject->setCode(123);
        $this->assertSame('123', $this->subject->getCode());
    }

    /**
     * @test
     */
    public function setCodeWithBooleanResultsInString() {
        $this->subject->setCode(TRUE);
        $this->assertSame('1', $this->subject->getCode());
    }

    /**
     * @test
     */
    public function getTokenInitiallyReturnsEmptyString() {
        $this->assertSame(
            '',
            $this->subject->getToken()
        );
    }

    /**
     * @test
     */
    public function setTokenSetsToken() {
        $this->subject->setToken('foo bar');

        $this->assertSame(
            'foo bar',
            $this->subject->getToken()
        );
    }

    /**
     * @test
     */
    public function setTokenWithIntegerResultsInString() {
        $this->subject->setToken(123);
        $this->assertSame('123', $this->subject->getToken());
    }

    /**
     * @test
     */
    public function setTokenWithBooleanResultsInString() {
        $this->subject->setToken(TRUE);
        $this->assertSame('1', $this->subject->getToken());
    }

    /**
     * @test
     */
    public function getDepartmentInitiallyReturnsNull() {
        $this->assertNull($this->subject->getDepartment());
    }

    /**
     * @test
     */
    public function setDepartmentSetsDepartment() {
        $instance = new Department();
        $this->subject->setDepartment($instance);

        $this->assertSame(
            $instance,
            $this->subject->getDepartment()
        );
    }

    /**
     * @test
     */
    public function getSubjectFieldInitiallyReturnsNull() {
        $this->assertNull($this->subject->getSubjectField());
    }

    /**
     * @test
     */
    public function setSubjectFieldSetsSubjectField() {
        $instance = new SubjectField();
        $this->subject->setSubjectField($instance);

        $this->assertSame(
            $instance,
            $this->subject->getSubjectField()
        );
    }
}
