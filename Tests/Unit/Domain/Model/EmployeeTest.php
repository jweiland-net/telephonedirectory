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
use PHPUnit\Framework\Attributes\Test;
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

    #[Test]
    public function getHiddenInitiallyReturnstrue(): void
    {
        self::assertTrue(
            $this->subject->isHidden(),
        );
    }

    #[Test]
    public function setHiddenSetsHidden(): void
    {
        $this->subject->setHidden(true);
        self::assertTrue(
            $this->subject->isHidden(),
        );
    }

    #[Test]
    public function getTitleInitiallyReturnsZero(): void
    {
        self::assertSame(
            0,
            $this->subject->getTitle(),
        );
    }

    #[Test]
    public function setTitleSetsTitle(): void
    {
        $this->subject->setTitle(123456);

        self::assertSame(
            123456,
            $this->subject->getTitle(),
        );
    }

    #[Test]
    public function getFirstNameInitiallyReturnsEmptyString(): void
    {
        self::assertSame(
            '',
            $this->subject->getFirstName(),
        );
    }

    #[Test]
    public function setFirstNameSetsFirstName(): void
    {
        $this->subject->setFirstName('foo bar');

        self::assertSame(
            'foo bar',
            $this->subject->getFirstName(),
        );
    }

    #[Test]
    public function getLastNameInitiallyReturnsEmptyString(): void
    {
        self::assertSame(
            '',
            $this->subject->getLastName(),
        );
    }

    #[Test]
    public function setLastNameSetsLastName(): void
    {
        $this->subject->setLastName('foo bar');

        self::assertSame(
            'foo bar',
            $this->subject->getLastName(),
        );
    }

    #[Test]
    public function getNameAdditionsInitiallyReturnsEmptyString(): void
    {
        self::assertSame(
            '',
            $this->subject->getNameAdditions(),
        );
    }

    #[Test]
    public function setNameAdditionsSetsNameAdditions(): void
    {
        $this->subject->setNameAdditions('foo bar');

        self::assertSame(
            'foo bar',
            $this->subject->getNameAdditions(),
        );
    }

    #[Test]
    public function getIsCatchAllMailInitiallyReturnsfalse(): void
    {
        self::assertFalse(
            $this->subject->getIsCatchAllMail(),
        );
    }

    #[Test]
    public function setIsCatchAllMailSetsIsCatchAllMail(): void
    {
        $this->subject->setIsCatchAllMail(true);
        self::assertTrue(
            $this->subject->getIsCatchAllMail(),
        );
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
    public function getCompanyInitiallyReturnsEmptyString(): void
    {
        self::assertSame(
            '',
            $this->subject->getCompany(),
        );
    }

    #[Test]
    public function setCompanySetsCompany(): void
    {
        $this->subject->setCompany('foo bar');

        self::assertSame(
            'foo bar',
            $this->subject->getCompany(),
        );
    }

    #[Test]
    public function getRoomNumberInitiallyReturnsEmptyString(): void
    {
        self::assertSame(
            '',
            $this->subject->getRoomNumber(),
        );
    }

    #[Test]
    public function setRoomNumberSetsRoomNumber(): void
    {
        $this->subject->setRoomNumber('foo bar');

        self::assertSame(
            'foo bar',
            $this->subject->getRoomNumber(),
        );
    }

    #[Test]
    public function getFunctionInitiallyReturnsEmptyString(): void
    {
        self::assertSame(
            '',
            $this->subject->getFunction(),
        );
    }

    #[Test]
    public function setFunctionSetsFunction(): void
    {
        $this->subject->setFunction('foo bar');

        self::assertSame(
            'foo bar',
            $this->subject->getFunction(),
        );
    }

    #[Test]
    public function getAdditionalFunctionInitiallyReturnsObjectStorage(): void
    {
        self::assertEquals(
            new ObjectStorage(),
            $this->subject->getAdditionalFunction(),
        );
    }

    #[Test]
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

    #[Test]
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

    #[Test]
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

    #[Test]
    public function getTelephone1InitiallyReturnsEmptyString(): void
    {
        self::assertSame(
            '',
            $this->subject->getTelephone1(),
        );
    }

    #[Test]
    public function setTelephone1SetsTelephone1(): void
    {
        $this->subject->setTelephone1('foo bar');

        self::assertSame(
            'foo bar',
            $this->subject->getTelephone1(),
        );
    }

    #[Test]
    public function getTelephone2InitiallyReturnsEmptyString(): void
    {
        self::assertSame(
            '',
            $this->subject->getTelephone2(),
        );
    }

    #[Test]
    public function setTelephone2SetsTelephone2(): void
    {
        $this->subject->setTelephone2('foo bar');

        self::assertSame(
            'foo bar',
            $this->subject->getTelephone2(),
        );
    }

    #[Test]
    public function getTelephone3InitiallyReturnsEmptyString(): void
    {
        self::assertSame(
            '',
            $this->subject->getTelephone3(),
        );
    }

    #[Test]
    public function setTelephone3SetsTelephone3(): void
    {
        $this->subject->setTelephone3('foo bar');

        self::assertSame(
            'foo bar',
            $this->subject->getTelephone3(),
        );
    }

    #[Test]
    public function getMobileInitiallyReturnsEmptyString(): void
    {
        self::assertSame(
            '',
            $this->subject->getMobile(),
        );
    }

    #[Test]
    public function setMobileSetsMobile(): void
    {
        $this->subject->setMobile('foo bar');

        self::assertSame(
            'foo bar',
            $this->subject->getMobile(),
        );
    }

    #[Test]
    public function getPagerInitiallyReturnsEmptyString(): void
    {
        self::assertSame(
            '',
            $this->subject->getPager(),
        );
    }

    #[Test]
    public function setPagerSetsPager(): void
    {
        $this->subject->setPager('foo bar');

        self::assertSame(
            'foo bar',
            $this->subject->getPager(),
        );
    }

    #[Test]
    public function getFaxInitiallyReturnsEmptyString(): void
    {
        self::assertSame(
            '',
            $this->subject->getFax(),
        );
    }

    #[Test]
    public function setFaxSetsFax(): void
    {
        $this->subject->setFax('foo bar');

        self::assertSame(
            'foo bar',
            $this->subject->getFax(),
        );
    }

    #[Test]
    public function getPcFaxInitiallyReturnsEmptyString(): void
    {
        self::assertSame(
            '',
            $this->subject->getPcFax(),
        );
    }

    #[Test]
    public function setPcFaxSetsPcFax(): void
    {
        $this->subject->setPcFax('foo bar');

        self::assertSame(
            'foo bar',
            $this->subject->getPcFax(),
        );
    }

    #[Test]
    public function getEmailInitiallyReturnsEmptyString(): void
    {
        self::assertSame(
            '',
            $this->subject->getEmail(),
        );
    }

    #[Test]
    public function setEmailSetsEmail(): void
    {
        $this->subject->setEmail('foo bar');

        self::assertSame(
            'foo bar',
            $this->subject->getEmail(),
        );
    }

    #[Test]
    public function getAdditionalInformationsInitiallyReturnsEmptyString(): void
    {
        self::assertSame(
            '',
            $this->subject->getAdditionalInformations(),
        );
    }

    #[Test]
    public function setAdditionalInformationsSetsAdditionalInformations(): void
    {
        $this->subject->setAdditionalInformations('foo bar');

        self::assertSame(
            'foo bar',
            $this->subject->getAdditionalInformations(),
        );
    }

    #[Test]
    public function getRegularAttendanceInitiallyReturnsEmptyString(): void
    {
        self::assertSame(
            '',
            $this->subject->getRegularAttendance(),
        );
    }

    #[Test]
    public function setRegularAttendanceSetsRegularAttendance(): void
    {
        $this->subject->setRegularAttendance('foo bar');

        self::assertSame(
            'foo bar',
            $this->subject->getRegularAttendance(),
        );
    }

    #[Test]
    public function getModuleSysDmailHtmlInitiallyReturnstrue(): void
    {
        self::assertTrue(
            $this->subject->getModuleSysDmailHtml(),
        );
    }

    #[Test]
    public function setModuleSysDmailHtmlSetsModuleSysDmailHtml(): void
    {
        $this->subject->setModuleSysDmailHtml(true);
        self::assertTrue(
            $this->subject->getModuleSysDmailHtml(),
        );
    }

    #[Test]
    public function getOfficeInitiallyReturnsNull(): void
    {
        self::assertNull($this->subject->getOffice());
    }

    #[Test]
    public function setOfficeSetsOffice(): void
    {
        $instance = new Office();
        $this->subject->setOffice($instance);

        self::assertSame(
            $instance,
            $this->subject->getOffice(),
        );
    }

    #[Test]
    public function getBuildingInitiallyReturnsNull(): void
    {
        self::assertNull($this->subject->getBuilding());
    }

    #[Test]
    public function setBuildingSetsBuilding(): void
    {
        $instance = new Building();
        $this->subject->setBuilding($instance);

        self::assertSame(
            $instance,
            $this->subject->getBuilding(),
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
    public function getImageInitiallyIsEmpty(): void
    {
        self::assertEmpty($this->subject->getImage());
    }

    #[Test]
    public function getFirstImageInitiallyReturnsNull(): void
    {
        self::assertEmpty($this->subject->getFirstImage());
    }

    #[Test]
    public function getFirstImageReturnsFirstImage(): void
    {
        $instance = new FileReference();
        $this->subject->getImage()->attach($instance);

        self::assertSame(
            $instance,
            $this->subject->getFirstImage(),
        );
    }

    #[Test]
    public function getLanguageSkillInitiallyReturnsObjectStorage(): void
    {
        self::assertEquals(
            new ObjectStorage(),
            $this->subject->getLanguageSkill(),
        );
    }

    #[Test]
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

    #[Test]
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

    #[Test]
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
