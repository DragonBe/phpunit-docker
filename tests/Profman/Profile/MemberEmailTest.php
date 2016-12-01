<?php

namespace Profman\Test\Profile;


use Profman\Profile\MemberEmail;

/**
 * Class MemberEmailTest
 *
 * @package Profman\Test\Profile
 * @group Member
 */
class MemberEmailTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Creates a Mock object for validations
     *
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    protected function getValidatorMock()
    {
        return $this->getMockBuilder(\Profman\Catalog\ValidatorInterface::class)
            ->setMethods(['isValid'])
            ->getMock();
    }

    /**
     * Generates bad data input examples for testing purposes
     *
     * @return array
     */
    public function badUuidDataProvider()
    {
        return [
            [''],
            ['12345'],
            ['FOO'],
            [str_repeat('x', 10000)],
            [123],
            [0xabc],
            [012],
        ];
    }

    /**
     * Test rejection of invalid object ID's
     *
     * @param string $id
     *
     * @covers \Profman\Profile\MemberEmail::__construct
     * @covers \Profman\Profile\MemberEmail::setId
     * @dataProvider badUuidDataProvider
     * @expectedException \InvalidArgumentException
     */
    public function testRejectsInvalidIds($id)
    {
        $uuidValidator = $this->getValidatorMock();
        $uuidValidator->expects($this->once())
            ->method('isValid')
            ->willReturn(false);

        $pmMemberEmail = new MemberEmail(['uuid' => $uuidValidator]);
        $pmMemberEmail->setId($id);
        $this->fail('Expected exception was not thrown!');
    }

    /**
     * Test rejection of invalid member ID's
     *
     * @param string $id
     *
     * @covers \Profman\Profile\MemberEmail::__construct
     * @covers \Profman\Profile\MemberEmail::setMemberId
     * @dataProvider badUuidDataProvider
     * @expectedException \InvalidArgumentException
     */
    public function testRejectsInvalidMemberIds($id)
    {
        $uuidValidator = $this->getValidatorMock();
        $uuidValidator->expects($this->once())
            ->method('isValid')
            ->willReturn(false);

        $pmMemberEmail = new MemberEmail(['uuid' => $uuidValidator]);
        $pmMemberEmail->setMemberId($id);
        $this->fail('Expected exception was not thrown!');
    }

    /**
     * Data provider for testing faulty email addresses
     *
     * @return array
     */
    public function badEmailDataProvider()
    {
        return [
            [''],
            ['FOO'],
            [123],
            [str_repeat('x', 10000)],
            [0x1234],
            [012],
        ];
    }

    /**
     * Test rejection of invalid member email addresses
     *
     * @param string $email
     *
     * @covers \Profman\Profile\MemberEmail::__construct
     * @covers \Profman\Profile\MemberEmail::setEmail
     * @expectedException \InvalidArgumentException
     * @dataProvider badEmailDataProvider
     */
    public function testRejectsInvalidMemberEmailAddresses($email)
    {
        $emailValidator = $this->getValidatorMock();
        $emailValidator->expects($this->once())
            ->method('isValid')
            ->willReturn(false);

        $pmMemberEmail = new MemberEmail(['email' => $emailValidator]);
        $pmMemberEmail->setEmail($email);
        $this->fail('Expected exception was not thrown');
    }

    /**
     * A provider of good UUID's
     *
     * @return array
     */
    public function goodUuidProvider()
    {
        $faker = \Faker\Factory::create();
        $values = [];
        $fakercnt = getenv('FAKERCNT');
        for ($i = 0; $i < $fakercnt; $i++) {
            $values[] = [$faker->uuid];
        }
        return $values;
    }
    /**
     * Test acceptation of valid object ID's
     *
     * @param string $id
     *
     * @covers \Profman\Profile\MemberEmail::__construct
     * @covers \Profman\Profile\MemberEmail::setId
     * @covers \Profman\Profile\MemberEmail::getId
     * @dataProvider goodUuidProvider
     */
    public function testAcceptValidIds($id)
    {
        $uuidValidator = $this->getValidatorMock();
        $uuidValidator->expects($this->once())
            ->method('isValid')
            ->willReturn(true);

        $pmMemberEmail = new MemberEmail(['uuid' => $uuidValidator]);
        $pmMemberEmail->setId($id);

        $this->assertSame($id, $pmMemberEmail->getId());
    }

    /**
     * Test acceptation of valid member ID's
     *
     * @param string $memberId
     *
     * @covers \Profman\Profile\MemberEmail::__construct
     * @covers \Profman\Profile\MemberEmail::setMemberId
     * @covers \Profman\Profile\MemberEmail::getMemberId
     * @dataProvider goodUuidProvider
     */
    public function testAcceptValidMemberIds($memberId)
    {
        $uuidValidator = $this->getValidatorMock();
        $uuidValidator->expects($this->once())
            ->method('isValid')
            ->willReturn(true);

        $pmMemberEmail = new MemberEmail(['uuid' => $uuidValidator]);
        $pmMemberEmail->setMemberId($memberId);

        $this->assertSame($memberId, $pmMemberEmail->getMemberId());
    }

    /**
     * Data provider of correct email addresses
     *
     * @return array
     */
    public function goodEmailDataProvider()
    {
        $fakercnt = getenv('FAKERCNT');
        $faker = \Faker\Factory::create();
        $values = [];
        for ($i = 0; $i < $fakercnt; $i++) {
            $values[] = [$faker->email];
        }
        return $values;
    }

    /**
     * Test acceptation of valid member email addresses
     *
     * @param string $email
     *
     * @covers \Profman\Profile\MemberEmail::__construct
     * @covers \Profman\Profile\MemberEmail::setEmail
     * @covers \Profman\Profile\MemberEmail::getEmail
     * @dataProvider goodEmailDataProvider
     */
    public function testAcceptValidMemberEmailAddresses($email)
    {
        $emailValidator = $this->getValidatorMock();
        $emailValidator->expects($this->once())
            ->method('isValid')
            ->willReturn(true);

        $pmMemberEmail = new MemberEmail(['email' => $emailValidator]);
        $pmMemberEmail->setEmail($email);

        $this->assertSame($email, $pmMemberEmail->getEmail());
    }
}