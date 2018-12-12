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
use JWeiland\Telephonedirectory\Domain\Model\Building;
use JWeiland\Telephonedirectory\Domain\Model\Department;
use JWeiland\Telephonedirectory\Domain\Model\Employee;
use JWeiland\Telephonedirectory\Domain\Model\LanguageSkill;
use JWeiland\Telephonedirectory\Domain\Model\Office;
use JWeiland\Telephonedirectory\Domain\Model\SubjectField;
use Nimut\TestingFramework\TestCase\UnitTestCase;
use TYPO3\CMS\Extbase\Domain\Model\Category;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

/**
 * Test case.
 */
class EmployeeTest extends UnitTestCase
{
    /**
     * @var Employee
     */
    protected $subject;

    /**
     * set up.
     */
    public function setUp()
    {
        $this->subject = new Employee();
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
    public function getHiddenInitiallyReturnstrue() {
        $this->assertSame(
            true,
            $this->subject->isHidden()
        );
    }

    /**
     * @test
     */
    public function setHiddenSetsHidden() {
        $this->subject->setHidden(true);
        $this->assertSame(
            true,
            $this->subject->isHidden()
        );
    }

    /**
     * @test
     */
    public function setHiddenWithStringReturnstrue() {
        $this->subject->setHidden('foo bar');
        $this->asserttrue($this->subject->isHidden());
    }

    /**
     * @test
     */
    public function setHiddenWithZeroReturnsfalse() {
        $this->subject->setHidden(0);
        $this->assertfalse($this->subject->isHidden());
    }

    /**
     * @test
     */
    public function getTitleInitiallyReturnsZero() {
        $this->assertSame(
            0,
            $this->subject->getTitle()
        );
    }

    /**
     * @test
     */
    public function setTitleSetsTitle() {
        $this->subject->setTitle(123456);

        $this->assertSame(
            123456,
            $this->subject->getTitle()
        );
    }

    /**
     * @test
     */
    public function setTitleWithStringResultsInInteger() {
        $this->subject->setTitle('123Test');

        $this->assertSame(
            123,
            $this->subject->getTitle()
        );
    }

    /**
     * @test
     */
    public function setTitleWithBooleanResultsInInteger() {
        $this->subject->setTitle(true);

        $this->assertSame(
            1,
            $this->subject->getTitle()
        );
    }

    /**
     * @test
     */
    public function getFirstNameInitiallyReturnsEmptyString() {
        $this->assertSame(
            '',
            $this->subject->getFirstName()
        );
    }

    /**
     * @test
     */
    public function setFirstNameSetsFirstName() {
        $this->subject->setFirstName('foo bar');

        $this->assertSame(
            'foo bar',
            $this->subject->getFirstName()
        );
    }

    /**
     * @test
     */
    public function setFirstNameWithIntegerResultsInString() {
        $this->subject->setFirstName(123);
        $this->assertSame('123', $this->subject->getFirstName());
    }

    /**
     * @test
     */
    public function setFirstNameWithBooleanResultsInString() {
        $this->subject->setFirstName(true);
        $this->assertSame('1', $this->subject->getFirstName());
    }

    /**
     * @test
     */
    public function getLastNameInitiallyReturnsEmptyString() {
        $this->assertSame(
            '',
            $this->subject->getLastName()
        );
    }

    /**
     * @test
     */
    public function setLastNameSetsLastName() {
        $this->subject->setLastName('foo bar');

        $this->assertSame(
            'foo bar',
            $this->subject->getLastName()
        );
    }

    /**
     * @test
     */
    public function setLastNameWithIntegerResultsInString() {
        $this->subject->setLastName(123);
        $this->assertSame('123', $this->subject->getLastName());
    }

    /**
     * @test
     */
    public function setLastNameWithBooleanResultsInString() {
        $this->subject->setLastName(true);
        $this->assertSame('1', $this->subject->getLastName());
    }

    /**
     * @test
     */
    public function getNameAdditionsInitiallyReturnsEmptyString() {
        $this->assertSame(
            '',
            $this->subject->getNameAdditions()
        );
    }

    /**
     * @test
     */
    public function setNameAdditionsSetsNameAdditions() {
        $this->subject->setNameAdditions('foo bar');

        $this->assertSame(
            'foo bar',
            $this->subject->getNameAdditions()
        );
    }

    /**
     * @test
     */
    public function setNameAdditionsWithIntegerResultsInString() {
        $this->subject->setNameAdditions(123);
        $this->assertSame('123', $this->subject->getNameAdditions());
    }

    /**
     * @test
     */
    public function setNameAdditionsWithBooleanResultsInString() {
        $this->subject->setNameAdditions(true);
        $this->assertSame('1', $this->subject->getNameAdditions());
    }

    /**
     * @test
     */
    public function getIsCatchAllMailInitiallyReturnsfalse() {
        $this->assertSame(
            false,
            $this->subject->getIsCatchAllMail()
        );
    }

    /**
     * @test
     */
    public function setIsCatchAllMailSetsIsCatchAllMail() {
        $this->subject->setIsCatchAllMail(true);
        $this->assertSame(
            true,
            $this->subject->getIsCatchAllMail()
        );
    }

    /**
     * @test
     */
    public function setIsCatchAllMailWithStringReturnstrue() {
        $this->subject->setIsCatchAllMail('foo bar');
        $this->asserttrue($this->subject->getIsCatchAllMail());
    }

    /**
     * @test
     */
    public function setIsCatchAllMailWithZeroReturnsfalse() {
        $this->subject->setIsCatchAllMail(0);
        $this->assertfalse($this->subject->getIsCatchAllMail());
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

    /**
     * @test
     */
    public function getCompanyInitiallyReturnsEmptyString() {
        $this->assertSame(
            '',
            $this->subject->getCompany()
        );
    }

    /**
     * @test
     */
    public function setCompanySetsCompany() {
        $this->subject->setCompany('foo bar');

        $this->assertSame(
            'foo bar',
            $this->subject->getCompany()
        );
    }

    /**
     * @test
     */
    public function setCompanyWithIntegerResultsInString() {
        $this->subject->setCompany(123);
        $this->assertSame('123', $this->subject->getCompany());
    }

    /**
     * @test
     */
    public function setCompanyWithBooleanResultsInString() {
        $this->subject->setCompany(true);
        $this->assertSame('1', $this->subject->getCompany());
    }

    /**
     * @test
     */
    public function getRoomNumberInitiallyReturnsEmptyString() {
        $this->assertSame(
            '',
            $this->subject->getRoomNumber()
        );
    }

    /**
     * @test
     */
    public function setRoomNumberSetsRoomNumber() {
        $this->subject->setRoomNumber('foo bar');

        $this->assertSame(
            'foo bar',
            $this->subject->getRoomNumber()
        );
    }

    /**
     * @test
     */
    public function setRoomNumberWithIntegerResultsInString() {
        $this->subject->setRoomNumber(123);
        $this->assertSame('123', $this->subject->getRoomNumber());
    }

    /**
     * @test
     */
    public function setRoomNumberWithBooleanResultsInString() {
        $this->subject->setRoomNumber(true);
        $this->assertSame('1', $this->subject->getRoomNumber());
    }

    /**
     * @test
     */
    public function getFunctionInitiallyReturnsEmptyString() {
        $this->assertSame(
            '',
            $this->subject->getFunction()
        );
    }

    /**
     * @test
     */
    public function setFunctionSetsFunction() {
        $this->subject->setFunction('foo bar');

        $this->assertSame(
            'foo bar',
            $this->subject->getFunction()
        );
    }

    /**
     * @test
     */
    public function setFunctionWithIntegerResultsInString() {
        $this->subject->setFunction(123);
        $this->assertSame('123', $this->subject->getFunction());
    }

    /**
     * @test
     */
    public function setFunctionWithBooleanResultsInString() {
        $this->subject->setFunction(true);
        $this->assertSame('1', $this->subject->getFunction());
    }

    /**
     * @test
     */
    public function getAdditionalFunctionInitiallyReturnsObjectStorage() {
        $this->assertEquals(
            new ObjectStorage(),
            $this->subject->getAdditionalFunction()
        );
    }

    /**
     * @test
     */
    public function setAdditionalFunctionSetsAdditionalFunction() {
        $object = new Category();
        $objectStorage = new ObjectStorage();
        $objectStorage->attach($object);
        $this->subject->setAdditionalFunction($objectStorage);

        $this->assertSame(
            $objectStorage,
            $this->subject->getAdditionalFunction()
        );
    }

    /**
     * @test
     */
    public function addAdditionalFunctionAddsOneAdditionalFunction() {
        $objectStorage = new ObjectStorage();
        $this->subject->setAdditionalFunction($objectStorage);

        $object = new Category();
        $this->subject->addAdditionalFunction($object);

        $objectStorage->attach($object);

        $this->assertSame(
            $objectStorage,
            $this->subject->getAdditionalFunction()
        );
    }

    /**
     * @test
     */
    public function removeAdditionalFunctionRemovesOneAdditionalFunction() {
        $object = new Category();
        $objectStorage = new ObjectStorage();
        $objectStorage->attach($object);
        $this->subject->setAdditionalFunction($objectStorage);

        $this->subject->removeAdditionalFunction($object);
        $objectStorage->detach($object);

        $this->assertSame(
            $objectStorage,
            $this->subject->getAdditionalFunction()
        );
    }

    /**
     * @test
     */
    public function getTelephone1InitiallyReturnsEmptyString() {
        $this->assertSame(
            '',
            $this->subject->getTelephone1()
        );
    }

    /**
     * @test
     */
    public function setTelephone1SetsTelephone1() {
        $this->subject->setTelephone1('foo bar');

        $this->assertSame(
            'foo bar',
            $this->subject->getTelephone1()
        );
    }

    /**
     * @test
     */
    public function setTelephone1WithIntegerResultsInString() {
        $this->subject->setTelephone1(123);
        $this->assertSame('123', $this->subject->getTelephone1());
    }

    /**
     * @test
     */
    public function setTelephone1WithBooleanResultsInString() {
        $this->subject->setTelephone1(true);
        $this->assertSame('1', $this->subject->getTelephone1());
    }

    /**
     * @test
     */
    public function getTelephone2InitiallyReturnsEmptyString() {
        $this->assertSame(
            '',
            $this->subject->getTelephone2()
        );
    }

    /**
     * @test
     */
    public function setTelephone2SetsTelephone2() {
        $this->subject->setTelephone2('foo bar');

        $this->assertSame(
            'foo bar',
            $this->subject->getTelephone2()
        );
    }

    /**
     * @test
     */
    public function setTelephone2WithIntegerResultsInString() {
        $this->subject->setTelephone2(123);
        $this->assertSame('123', $this->subject->getTelephone2());
    }

    /**
     * @test
     */
    public function setTelephone2WithBooleanResultsInString() {
        $this->subject->setTelephone2(true);
        $this->assertSame('1', $this->subject->getTelephone2());
    }

    /**
     * @test
     */
    public function getTelephone3InitiallyReturnsEmptyString() {
        $this->assertSame(
            '',
            $this->subject->getTelephone3()
        );
    }

    /**
     * @test
     */
    public function setTelephone3SetsTelephone3() {
        $this->subject->setTelephone3('foo bar');

        $this->assertSame(
            'foo bar',
            $this->subject->getTelephone3()
        );
    }

    /**
     * @test
     */
    public function setTelephone3WithIntegerResultsInString() {
        $this->subject->setTelephone3(123);
        $this->assertSame('123', $this->subject->getTelephone3());
    }

    /**
     * @test
     */
    public function setTelephone3WithBooleanResultsInString() {
        $this->subject->setTelephone3(true);
        $this->assertSame('1', $this->subject->getTelephone3());
    }

    /**
     * @test
     */
    public function getMobileInitiallyReturnsEmptyString() {
        $this->assertSame(
            '',
            $this->subject->getMobile()
        );
    }

    /**
     * @test
     */
    public function setMobileSetsMobile() {
        $this->subject->setMobile('foo bar');

        $this->assertSame(
            'foo bar',
            $this->subject->getMobile()
        );
    }

    /**
     * @test
     */
    public function setMobileWithIntegerResultsInString() {
        $this->subject->setMobile(123);
        $this->assertSame('123', $this->subject->getMobile());
    }

    /**
     * @test
     */
    public function setMobileWithBooleanResultsInString() {
        $this->subject->setMobile(true);
        $this->assertSame('1', $this->subject->getMobile());
    }

    /**
     * @test
     */
    public function getPagerInitiallyReturnsEmptyString() {
        $this->assertSame(
            '',
            $this->subject->getPager()
        );
    }

    /**
     * @test
     */
    public function setPagerSetsPager() {
        $this->subject->setPager('foo bar');

        $this->assertSame(
            'foo bar',
            $this->subject->getPager()
        );
    }

    /**
     * @test
     */
    public function setPagerWithIntegerResultsInString() {
        $this->subject->setPager(123);
        $this->assertSame('123', $this->subject->getPager());
    }

    /**
     * @test
     */
    public function setPagerWithBooleanResultsInString() {
        $this->subject->setPager(true);
        $this->assertSame('1', $this->subject->getPager());
    }

    /**
     * @test
     */
    public function getFaxInitiallyReturnsEmptyString() {
        $this->assertSame(
            '',
            $this->subject->getFax()
        );
    }

    /**
     * @test
     */
    public function setFaxSetsFax() {
        $this->subject->setFax('foo bar');

        $this->assertSame(
            'foo bar',
            $this->subject->getFax()
        );
    }

    /**
     * @test
     */
    public function setFaxWithIntegerResultsInString() {
        $this->subject->setFax(123);
        $this->assertSame('123', $this->subject->getFax());
    }

    /**
     * @test
     */
    public function setFaxWithBooleanResultsInString() {
        $this->subject->setFax(true);
        $this->assertSame('1', $this->subject->getFax());
    }

    /**
     * @test
     */
    public function getPcFaxInitiallyReturnsEmptyString() {
        $this->assertSame(
            '',
            $this->subject->getPcFax()
        );
    }

    /**
     * @test
     */
    public function setPcFaxSetsPcFax() {
        $this->subject->setPcFax('foo bar');

        $this->assertSame(
            'foo bar',
            $this->subject->getPcFax()
        );
    }

    /**
     * @test
     */
    public function setPcFaxWithIntegerResultsInString() {
        $this->subject->setPcFax(123);
        $this->assertSame('123', $this->subject->getPcFax());
    }

    /**
     * @test
     */
    public function setPcFaxWithBooleanResultsInString() {
        $this->subject->setPcFax(true);
        $this->assertSame('1', $this->subject->getPcFax());
    }

    /**
     * @test
     */
    public function getEmailInitiallyReturnsEmptyString() {
        $this->assertSame(
            '',
            $this->subject->getEmail()
        );
    }

    /**
     * @test
     */
    public function setEmailSetsEmail() {
        $this->subject->setEmail('foo bar');

        $this->assertSame(
            'foo bar',
            $this->subject->getEmail()
        );
    }

    /**
     * @test
     */
    public function setEmailWithIntegerResultsInString() {
        $this->subject->setEmail(123);
        $this->assertSame('123', $this->subject->getEmail());
    }

    /**
     * @test
     */
    public function setEmailWithBooleanResultsInString() {
        $this->subject->setEmail(true);
        $this->assertSame('1', $this->subject->getEmail());
    }

    /**
     * @test
     */
    public function getAdditionalInformationsInitiallyReturnsEmptyString() {
        $this->assertSame(
            '',
            $this->subject->getAdditionalInformations()
        );
    }

    /**
     * @test
     */
    public function setAdditionalInformationsSetsAdditionalInformations() {
        $this->subject->setAdditionalInformations('foo bar');

        $this->assertSame(
            'foo bar',
            $this->subject->getAdditionalInformations()
        );
    }

    /**
     * @test
     */
    public function setAdditionalInformationsWithIntegerResultsInString() {
        $this->subject->setAdditionalInformations(123);
        $this->assertSame('123', $this->subject->getAdditionalInformations());
    }

    /**
     * @test
     */
    public function setAdditionalInformationsWithBooleanResultsInString() {
        $this->subject->setAdditionalInformations(true);
        $this->assertSame('1', $this->subject->getAdditionalInformations());
    }

    /**
     * @test
     */
    public function getRegularAttendanceInitiallyReturnsEmptyString() {
        $this->assertSame(
            '',
            $this->subject->getRegularAttendance()
        );
    }

    /**
     * @test
     */
    public function setRegularAttendanceSetsRegularAttendance() {
        $this->subject->setRegularAttendance('foo bar');

        $this->assertSame(
            'foo bar',
            $this->subject->getRegularAttendance()
        );
    }

    /**
     * @test
     */
    public function setRegularAttendanceWithIntegerResultsInString() {
        $this->subject->setRegularAttendance(123);
        $this->assertSame('123', $this->subject->getRegularAttendance());
    }

    /**
     * @test
     */
    public function setRegularAttendanceWithBooleanResultsInString() {
        $this->subject->setRegularAttendance(true);
        $this->assertSame('1', $this->subject->getRegularAttendance());
    }

    /**
     * @test
     */
    public function getModuleSysDmailHtmlInitiallyReturnstrue() {
        $this->assertSame(
            true,
            $this->subject->getModuleSysDmailHtml()
        );
    }

    /**
     * @test
     */
    public function setModuleSysDmailHtmlSetsModuleSysDmailHtml() {
        $this->subject->setModuleSysDmailHtml(true);
        $this->assertSame(
            true,
            $this->subject->getModuleSysDmailHtml()
        );
    }

    /**
     * @test
     */
    public function setModuleSysDmailHtmlWithStringReturnstrue() {
        $this->subject->setModuleSysDmailHtml('foo bar');
        $this->asserttrue($this->subject->getModuleSysDmailHtml());
    }

    /**
     * @test
     */
    public function setModuleSysDmailHtmlWithZeroReturnsfalse() {
        $this->subject->setModuleSysDmailHtml(0);
        $this->assertfalse($this->subject->getModuleSysDmailHtml());
    }

    /**
     * @test
     */
    public function getOfficeInitiallyReturnsNull() {
        $this->assertNull($this->subject->getOffice());
    }

    /**
     * @test
     */
    public function setOfficeSetsOffice() {
        $instance = new Office();
        $this->subject->setOffice($instance);

        $this->assertSame(
            $instance,
            $this->subject->getOffice()
        );
    }

    /**
     * @test
     */
    public function getBuildingInitiallyReturnsNull() {
        $this->assertNull($this->subject->getBuilding());
    }

    /**
     * @test
     */
    public function setBuildingSetsBuilding() {
        $instance = new Building();
        $this->subject->setBuilding($instance);

        $this->assertSame(
            $instance,
            $this->subject->getBuilding()
        );
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
    public function getImageInitiallyReturnsEmptyString() {
        $this->assertSame(
            '',
            $this->subject->getImage()
        );
    }

    /**
     * @test
     */
    public function setImageSetsImage() {
        $this->subject->setImage('foo bar');

        $this->assertSame(
            'foo bar',
            $this->subject->getImage()
        );
    }

    /**
     * @test
     */
    public function setImageWithIntegerResultsInString() {
        $this->subject->setImage(123);
        $this->assertSame('123', $this->subject->getImage());
    }

    /**
     * @test
     */
    public function setImageWithBooleanResultsInString() {
        $this->subject->setImage(true);
        $this->assertSame('1', $this->subject->getImage());
    }

    /**
     * @test
     */
    public function getLanguageSkillInitiallyReturnsObjectStorage() {
        $this->assertEquals(
            new ObjectStorage(),
            $this->subject->getLanguageSkill()
        );
    }

    /**
     * @test
     */
    public function setLanguageSkillSetsLanguageSkill() {
        $object = new LanguageSkill();
        $objectStorage = new ObjectStorage();
        $objectStorage->attach($object);
        $this->subject->setLanguageSkill($objectStorage);

        $this->assertSame(
            $objectStorage,
            $this->subject->getLanguageSkill()
        );
    }

    /**
     * @test
     */
    public function addLanguageSkillAddsOneLanguageSkill() {
        $objectStorage = new ObjectStorage();
        $this->subject->setLanguageSkill($objectStorage);

        $object = new LanguageSkill();
        $this->subject->addLanguageSkill($object);

        $objectStorage->attach($object);

        $this->assertSame(
            $objectStorage,
            $this->subject->getLanguageSkill()
        );
    }

    /**
     * @test
     */
    public function removeLanguageSkillRemovesOneLanguageSkill() {
        $object = new LanguageSkill();
        $objectStorage = new ObjectStorage();
        $objectStorage->attach($object);
        $this->subject->setLanguageSkill($objectStorage);

        $this->subject->removeLanguageSkill($object);
        $objectStorage->detach($object);

        $this->assertSame(
            $objectStorage,
            $this->subject->getLanguageSkill()
        );
    }
}
