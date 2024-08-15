<?php

declare(strict_types=1);

/*
 * This file is part of the package jweiland/telephonedirectory.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace JWeiland\Telephonedirectory\Tests\Unit\Domain\Model;

use JWeiland\Telephonedirectory\Domain\Model\Building;
use JWeiland\Telephonedirectory\Domain\Model\Category;
use JWeiland\Telephonedirectory\Domain\Model\Department;
use JWeiland\Telephonedirectory\Domain\Model\Employee;
use JWeiland\Telephonedirectory\Domain\Model\LanguageSkill;
use JWeiland\Telephonedirectory\Domain\Model\Office;
use JWeiland\Telephonedirectory\Domain\Model\SubjectField;
use TYPO3\CMS\Extbase\Domain\Model\FileReference;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;
use TYPO3\TestingFramework\Core\Unit\UnitTestCase;

/**
 * Test case.
 */
class EmployeeTest extends UnitTestCase
{
    protected Employee $subject;

    protected function setUp(): void
    {
        $this->subject = new Employee();
    }

    protected function tearDown(): void
    {
        unset($this->subject);
    }

    /**
     * @test
     */
    public function getHiddenInitiallyReturnstrue(): void
    {
        self::assertTrue(
            $this->subject->isHidden(),
        );
    }

    /**
     * @test
     */
    public function setHiddenSetsHidden(): void
    {
        $this->subject->setHidden(true);
        self::assertTrue(
            $this->subject->isHidden(),
        );
    }

    /**
     * @test
     */
    public function getTitleInitiallyReturnsZero(): void
    {
        self::assertSame(
            0,
            $this->subject->getTitle(),
        );
    }

    /**
     * @test
     */
    public function setTitleSetsTitle(): void
    {
        $this->subject->setTitle(123456);

        self::assertSame(
            123456,
            $this->subject->getTitle(),
        );
    }

    /**
     * @test
     */
    public function getFirstNameInitiallyReturnsEmptyString(): void
    {
        self::assertSame(
            '',
            $this->subject->getFirstName(),
        );
    }

    /**
     * @test
     */
    public function setFirstNameSetsFirstName(): void
    {
        $this->subject->setFirstName('foo bar');

        self::assertSame(
            'foo bar',
            $this->subject->getFirstName(),
        );
    }

    /**
     * @test
     */
    public function getLastNameInitiallyReturnsEmptyString(): void
    {
        self::assertSame(
            '',
            $this->subject->getLastName(),
        );
    }

    /**
     * @test
     */
    public function setLastNameSetsLastName(): void
    {
        $this->subject->setLastName('foo bar');

        self::assertSame(
            'foo bar',
            $this->subject->getLastName(),
        );
    }

    /**
     * @test
     */
    public function getNameAdditionsInitiallyReturnsEmptyString(): void
    {
        self::assertSame(
            '',
            $this->subject->getNameAdditions(),
        );
    }

    /**
     * @test
     */
    public function setNameAdditionsSetsNameAdditions(): void
    {
        $this->subject->setNameAdditions('foo bar');

        self::assertSame(
            'foo bar',
            $this->subject->getNameAdditions(),
        );
    }

    /**
     * @test
     */
    public function getIsCatchAllMailInitiallyReturnsfalse(): void
    {
        self::assertFalse(
            $this->subject->getIsCatchAllMail(),
        );
    }

    /**
     * @test
     */
    public function setIsCatchAllMailSetsIsCatchAllMail(): void
    {
        $this->subject->setIsCatchAllMail(true);
        self::assertTrue(
            $this->subject->getIsCatchAllMail(),
        );
    }

    /**
     * @test
     */
    public function getSubjectFieldInitiallyReturnsNull(): void
    {
        self::assertNull($this->subject->getSubjectField());
    }

    /**
     * @test
     */
    public function setSubjectFieldSetsSubjectField(): void
    {
        $instance = new SubjectField();
        $this->subject->setSubjectField($instance);

        self::assertSame(
            $instance,
            $this->subject->getSubjectField(),
        );
    }

    /**
     * @test
     */
    public function getCompanyInitiallyReturnsEmptyString(): void
    {
        self::assertSame(
            '',
            $this->subject->getCompany(),
        );
    }

    /**
     * @test
     */
    public function setCompanySetsCompany(): void
    {
        $this->subject->setCompany('foo bar');

        self::assertSame(
            'foo bar',
            $this->subject->getCompany(),
        );
    }

    /**
     * @test
     */
    public function getRoomNumberInitiallyReturnsEmptyString(): void
    {
        self::assertSame(
            '',
            $this->subject->getRoomNumber(),
        );
    }

    /**
     * @test
     */
    public function setRoomNumberSetsRoomNumber(): void
    {
        $this->subject->setRoomNumber('foo bar');

        self::assertSame(
            'foo bar',
            $this->subject->getRoomNumber(),
        );
    }

    /**
     * @test
     */
    public function getFunctionInitiallyReturnsEmptyString(): void
    {
        self::assertSame(
            '',
            $this->subject->getFunction(),
        );
    }

    /**
     * @test
     */
    public function setFunctionSetsFunction(): void
    {
        $this->subject->setFunction('foo bar');

        self::assertSame(
            'foo bar',
            $this->subject->getFunction(),
        );
    }

    /**
     * @test
     */
    public function getAdditionalFunctionInitiallyReturnsObjectStorage(): void
    {
        self::assertEquals(
            new ObjectStorage(),
            $this->subject->getAdditionalFunction(),
        );
    }

    /**
     * @test
     */
    public function setAdditionalFunctionSetsAdditionalFunction(): void
    {
        $object = new Category();
        $objectStorage = new ObjectStorage();
        $objectStorage->attach($object);
        $this->subject->setAdditionalFunction($objectStorage);

        self::assertSame(
            $objectStorage,
            $this->subject->getAdditionalFunction(),
        );
    }

    /**
     * @test
     */
    public function addAdditionalFunctionAddsOneAdditionalFunction(): void
    {
        $objectStorage = new ObjectStorage();
        $this->subject->setAdditionalFunction($objectStorage);

        $object = new Category();
        $this->subject->addAdditionalFunction($object);

        $objectStorage->attach($object);

        self::assertSame(
            $objectStorage,
            $this->subject->getAdditionalFunction(),
        );
    }

    /**
     * @test
     */
    public function removeAdditionalFunctionRemovesOneAdditionalFunction(): void
    {
        $object = new Category();
        $objectStorage = new ObjectStorage();
        $objectStorage->attach($object);
        $this->subject->setAdditionalFunction($objectStorage);

        $this->subject->removeAdditionalFunction($object);
        $objectStorage->detach($object);

        self::assertSame(
            $objectStorage,
            $this->subject->getAdditionalFunction(),
        );
    }

    /**
     * @test
     */
    public function getTelephone1InitiallyReturnsEmptyString(): void
    {
        self::assertSame(
            '',
            $this->subject->getTelephone1(),
        );
    }

    /**
     * @test
     */
    public function setTelephone1SetsTelephone1(): void
    {
        $this->subject->setTelephone1('foo bar');

        self::assertSame(
            'foo bar',
            $this->subject->getTelephone1(),
        );
    }

    /**
     * @test
     */
    public function getTelephone2InitiallyReturnsEmptyString(): void
    {
        self::assertSame(
            '',
            $this->subject->getTelephone2(),
        );
    }

    /**
     * @test
     */
    public function setTelephone2SetsTelephone2(): void
    {
        $this->subject->setTelephone2('foo bar');

        self::assertSame(
            'foo bar',
            $this->subject->getTelephone2(),
        );
    }

    /**
     * @test
     */
    public function getTelephone3InitiallyReturnsEmptyString(): void
    {
        self::assertSame(
            '',
            $this->subject->getTelephone3(),
        );
    }

    /**
     * @test
     */
    public function setTelephone3SetsTelephone3(): void
    {
        $this->subject->setTelephone3('foo bar');

        self::assertSame(
            'foo bar',
            $this->subject->getTelephone3(),
        );
    }

    /**
     * @test
     */
    public function getMobileInitiallyReturnsEmptyString(): void
    {
        self::assertSame(
            '',
            $this->subject->getMobile(),
        );
    }

    /**
     * @test
     */
    public function setMobileSetsMobile(): void
    {
        $this->subject->setMobile('foo bar');

        self::assertSame(
            'foo bar',
            $this->subject->getMobile(),
        );
    }

    /**
     * @test
     */
    public function getPagerInitiallyReturnsEmptyString(): void
    {
        self::assertSame(
            '',
            $this->subject->getPager(),
        );
    }

    /**
     * @test
     */
    public function setPagerSetsPager(): void
    {
        $this->subject->setPager('foo bar');

        self::assertSame(
            'foo bar',
            $this->subject->getPager(),
        );
    }

    /**
     * @test
     */
    public function getFaxInitiallyReturnsEmptyString(): void
    {
        self::assertSame(
            '',
            $this->subject->getFax(),
        );
    }

    /**
     * @test
     */
    public function setFaxSetsFax(): void
    {
        $this->subject->setFax('foo bar');

        self::assertSame(
            'foo bar',
            $this->subject->getFax(),
        );
    }

    /**
     * @test
     */
    public function getPcFaxInitiallyReturnsEmptyString(): void
    {
        self::assertSame(
            '',
            $this->subject->getPcFax(),
        );
    }

    /**
     * @test
     */
    public function setPcFaxSetsPcFax(): void
    {
        $this->subject->setPcFax('foo bar');

        self::assertSame(
            'foo bar',
            $this->subject->getPcFax(),
        );
    }

    /**
     * @test
     */
    public function getEmailInitiallyReturnsEmptyString(): void
    {
        self::assertSame(
            '',
            $this->subject->getEmail(),
        );
    }

    /**
     * @test
     */
    public function setEmailSetsEmail(): void
    {
        $this->subject->setEmail('foo bar');

        self::assertSame(
            'foo bar',
            $this->subject->getEmail(),
        );
    }

    /**
     * @test
     */
    public function getAdditionalInformationsInitiallyReturnsEmptyString(): void
    {
        self::assertSame(
            '',
            $this->subject->getAdditionalInformations(),
        );
    }

    /**
     * @test
     */
    public function setAdditionalInformationsSetsAdditionalInformations(): void
    {
        $this->subject->setAdditionalInformations('foo bar');

        self::assertSame(
            'foo bar',
            $this->subject->getAdditionalInformations(),
        );
    }

    /**
     * @test
     */
    public function getRegularAttendanceInitiallyReturnsEmptyString(): void
    {
        self::assertSame(
            '',
            $this->subject->getRegularAttendance(),
        );
    }

    /**
     * @test
     */
    public function setRegularAttendanceSetsRegularAttendance(): void
    {
        $this->subject->setRegularAttendance('foo bar');

        self::assertSame(
            'foo bar',
            $this->subject->getRegularAttendance(),
        );
    }

    /**
     * @test
     */
    public function getModuleSysDmailHtmlInitiallyReturnstrue(): void
    {
        self::assertTrue(
            $this->subject->getModuleSysDmailHtml(),
        );
    }

    /**
     * @test
     */
    public function setModuleSysDmailHtmlSetsModuleSysDmailHtml(): void
    {
        $this->subject->setModuleSysDmailHtml(true);
        self::assertTrue(
            $this->subject->getModuleSysDmailHtml(),
        );
    }

    /**
     * @test
     */
    public function getOfficeInitiallyReturnsNull(): void
    {
        self::assertNull($this->subject->getOffice());
    }

    /**
     * @test
     */
    public function setOfficeSetsOffice(): void
    {
        $instance = new Office();
        $this->subject->setOffice($instance);

        self::assertSame(
            $instance,
            $this->subject->getOffice(),
        );
    }

    /**
     * @test
     */
    public function getBuildingInitiallyReturnsNull(): void
    {
        self::assertNull($this->subject->getBuilding());
    }

    /**
     * @test
     */
    public function setBuildingSetsBuilding(): void
    {
        $instance = new Building();
        $this->subject->setBuilding($instance);

        self::assertSame(
            $instance,
            $this->subject->getBuilding(),
        );
    }

    /**
     * @test
     */
    public function getDepartmentInitiallyReturnsNull(): void
    {
        self::assertNull($this->subject->getDepartment());
    }

    /**
     * @test
     */
    public function setDepartmentSetsDepartment(): void
    {
        $instance = new Department();
        $this->subject->setDepartment($instance);

        self::assertSame(
            $instance,
            $this->subject->getDepartment(),
        );
    }

    /**
     * @test
     */
    public function getImageInitiallyIsEmpty(): void
    {
        self::assertEmpty($this->subject->getImage());
    }

    /**
     * @test
     */
    public function getFirstImageInitiallyReturnsNull(): void
    {
        self::assertEmpty($this->subject->getFirstImage());
    }

    /**
     * @test
     */
    public function getFirstImageReturnsFirstImage(): void
    {
        $instance = new FileReference();
        $this->subject->getImage()->attach($instance);

        self::assertSame(
            $instance,
            $this->subject->getFirstImage(),
        );
    }

    /**
     * @test
     */
    public function getLanguageSkillInitiallyReturnsObjectStorage(): void
    {
        self::assertEquals(
            new ObjectStorage(),
            $this->subject->getLanguageSkill(),
        );
    }

    /**
     * @test
     */
    public function setLanguageSkillSetsLanguageSkill(): void
    {
        $object = new LanguageSkill();
        $objectStorage = new ObjectStorage();
        $objectStorage->attach($object);
        $this->subject->setLanguageSkill($objectStorage);

        self::assertSame(
            $objectStorage,
            $this->subject->getLanguageSkill(),
        );
    }

    /**
     * @test
     */
    public function addLanguageSkillAddsOneLanguageSkill(): void
    {
        $objectStorage = new ObjectStorage();
        $this->subject->setLanguageSkill($objectStorage);

        $object = new LanguageSkill();
        $this->subject->addLanguageSkill($object);

        $objectStorage->attach($object);

        self::assertSame(
            $objectStorage,
            $this->subject->getLanguageSkill(),
        );
    }

    /**
     * @test
     */
    public function removeLanguageSkillRemovesOneLanguageSkill(): void
    {
        $object = new LanguageSkill();
        $objectStorage = new ObjectStorage();
        $objectStorage->attach($object);
        $this->subject->setLanguageSkill($objectStorage);

        $this->subject->removeLanguageSkill($object);
        $objectStorage->detach($object);

        self::assertSame(
            $objectStorage,
            $this->subject->getLanguageSkill(),
        );
    }
}
