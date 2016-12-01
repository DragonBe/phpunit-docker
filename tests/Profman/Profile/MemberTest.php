<?php

namespace Profman\Test\Profile;


use Profman\Catalog\ValidatorInterface;
use Profman\Profile\Member;
use Profman\Profile\MemberFactory;

/**
 * Class MemberTest
 *
 * @package Profman\Test\Profile
 * @group Member
 */
class MemberTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test that a member profile rejects empty values for required fields
     *
     * @covers \Profman\Profile\Member::setId
     * @expectedException \TypeError
     * @expectedExceptionMessageRegExp /Argument 1 passed to .* must be of the type string, null given,/
     */
    public function testRejectEmptyValuesForId()
    {
        $id = null;
        $pmMember = MemberFactory::create();
        $pmMember->setId($id);
    }
    /**
     * Test that a member profile rejects empty values for required fields
     *
     * @covers \Profman\Profile\Member::setFirstName
     * @expectedException \TypeError
     * @expectedExceptionMessageRegExp /Argument 1 passed to .* must be of the type string, null given,/
     */
    public function testRejectEmptyValuesForFirstName()
    {
        $firstName = null;
        $pmMember = MemberFactory::create();
        $pmMember->setFirstName($firstName);
    }

    /**
     * Test that a member profile rejects empty values for required fields
     *
     * @covers \Profman\Profile\Member::setLastName
     * @expectedException \TypeError
     * @expectedExceptionMessageRegExp /Argument 1 passed to .* must be of the type string, null given,/
     */
    public function testRejectEmptyValuesForLastName()
    {
        $lastName = null;
        $pmMember = MemberFactory::create();
        $pmMember->setLastName($lastName);
    }

    /**
     * Create a mock object for validations of UUID strings
     *
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    protected function createUuidValidatorMock()
    {
        return $this->getMockBuilder(ValidatorInterface::class)
            ->setMethods(['isValid'])
            ->getMock();
    }

    /**
     * Create a mock object for validations of UUID strings
     *
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    protected function createStringValidatorMock()
    {
        return $this->getMockBuilder(ValidatorInterface::class)
            ->setMethods(['isValid'])
            ->getMock();
    }

    /**
     * Test that a member profile rejects invalid values
     *
     * @covers \Profman\Profile\Member::setId
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Wrong format of UUID!
     */
    public function testRejectInvalidValuesForId()
    {
        $uuidValidator = $this->createUuidValidatorMock();

        $uuidValidator->expects($this->once())
            ->method('isValid')
            ->willReturn(false);

        $id = 1;
        $pmMember = new Member(['uuid' => $uuidValidator]);
        $pmMember->setId($id);
    }

    /**
     * Test that a member profile rejects invalid values
     *
     * @covers \Profman\Profile\Member::setFirstName
     * @expectedException \InvalidArgumentException
     */
    public function testRejectInvalidValuesForFirstName()
    {
        $stringValidator = $this->createStringValidatorMock();

        $stringValidator->expects($this->once())
            ->method('isValid')
            ->willReturn(false);

        $firstName = 1;
        $pmMember = new Member(['string' => $stringValidator]);
        $pmMember->setFirstName($firstName);
    }

    /**
     * Test that a member profile rejects invalid values
     *
     * @covers \Profman\Profile\Member::setLastName
     * @expectedException \InvalidArgumentException
     */
    public function testRejectInvalidValuesForLastName()
    {
        $stringValidator = $this->createStringValidatorMock();

        $stringValidator->expects($this->once())
            ->method('isValid')
            ->willReturn(false);

        $firstName = 1;
        $pmMember = new Member(['string' => $stringValidator]);
        $pmMember->setLastName($firstName);
    }

    /**
     * Data provider that will generate correct data for our member class
     *
     * @return array
     */
    public function goodDataProvider()
    {
        $fakercnt = (int) getenv('FAKERCNT');
        $values = [];
        $faker = \Faker\Factory::create();
        for ($i = 0; $i < $fakercnt; $i++) {
            $values[] = [
                $faker->uuid,
                $faker->firstName,
                $faker->lastName,
            ];
        }
        return $values;
    }

    /**
     * Test that a member profile accepts valid values
     *
     * @param string $uuid
     * @param string $firstName
     * @param string $lastName
     *
     * @covers \Profman\Profile\Member::setId
     * @covers \Profman\Profile\Member::getId
     * @covers \Profman\Profile\Member::setFirstName
     * @covers \Profman\Profile\Member::getFirstName
     * @covers \Profman\Profile\Member::setLastName
     * @covers \Profman\Profile\Member::getLastName
     *
     * @dataProvider goodDataProvider
     */
    public function testAcceptValidValues($uuid, $firstName, $lastName)
    {
        $pmMember = new Member();
        $pmMember->setId($uuid)
            ->setFirstName($firstName)
            ->setLastName($lastName);

        $this->assertInstanceOf('\\Profman\\Profile\\Member', $pmMember);
        $this->assertSame($uuid, $pmMember->getId());
        $this->assertSame($firstName, $pmMember->getFirstName());
        $this->assertSame($lastName, $pmMember->getLastName());
    }

    /**
     * Test to see if we can create a member object without arguments
     *
     * @covers \Profman\Profile\Member::__construct
     */
    public function testCanCreateMemberObjectWithoutArguments()
    {
        $pmMember = new Member();
        $this->assertInstanceOf(Member::class, $pmMember);
    }

    /**
     * Test to see if we can create a member object without arguments
     *
     * @covers \Profman\Profile\Member::__construct
     */
    public function testCanCreateMemberObjectWithArguments()
    {
        $pmMember = new Member(['foo' => 'bar']);
        $this->assertInstanceOf(Member::class, $pmMember);
    }
}