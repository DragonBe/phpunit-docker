<?php

namespace Profman\Test\Catalog\Email;

use Profman\Catalog\Email\EmailValidator;

/**
 * Class EmailValidatorTest
 * @package Profman\Test\Catalog\Uuid
 * @group Validator
 */
class EmailValidatorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test validation of email addresses fail when no validator is provided
     *
     * @covers \Profman\Catalog\Email\EmailValidator::isValid
     */
    public function testValidationReturnsFalseWhenNoValidatorIsProvided()
    {
        $emailValidator = new EmailValidator();
        $this->assertFalse($emailValidator->isValid([]));
    }

    /**
     * Test validation of email addresses fail when no email validator is provided
     *
     * @covers \Profman\Catalog\Email\EmailValidator::isValid
     */
    public function testValidationReturnsFalseWhenNoEmailValidatorIsProvided()
    {
        $emailValidator = new EmailValidator();
        $this->assertFalse($emailValidator->isValid(['foo' => 'foo@bar.com']));
    }

    /**
     * Provides faulty UUID's to feed on our tests
     *
     * @return array
     */
    public function badDataProvider()
    {
        return [
            ['1234'],
            ['Foo-bar'],
            [012],
            [0x0012],
        ];
    }
    /**
     * Tests that invalid email addresses are rejected
     *
     * @param string $email
     *
     * @covers \Profman\Catalog\Email\EmailValidator::isValid
     * @dataProvider badDataProvider
     */
    public function testValidationFailsForInvalidEmail($email)
    {
        $emailValidator = new EmailValidator();
        $valid = $emailValidator->isValid(['email' => $email]);
        $this->assertFalse($valid);
    }

    /**
     * Generates good data for our tests
     *
     * @return array
     */
    public function goodDataProvider()
    {
        $fakercnt = (int) getenv('FAKERCNT');
        $values = [];
        $faker = \Faker\Factory::create();
        for ($i = 0; $i < $fakercnt; $i++) {
            $values[] = [$faker->email];
        }
        return $values;
    }

    /**
     * Tests that valid email addresses are accepted
     *
     * @param string $email
     *
     * @covers \Profman\Catalog\Email\EmailValidator::isValid
     * @dataProvider goodDataProvider
     */
    public function testValidationSucceedsForValidUuid($email)
    {
        $emailValidator = new EmailValidator();
        $valid = $emailValidator->isValid(['email' => $email]);
        $this->assertTrue($valid);
    }
}