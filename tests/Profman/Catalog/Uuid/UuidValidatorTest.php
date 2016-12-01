<?php

namespace Profman\Test\Catalog\Uuid;

use Profman\Catalog\Uuid\UuidValidator;

/**
 * Class UuidValidatorTest
 * @package Profman\Test\Catalog\Uuid
 * @group Validator
 */
class UuidValidatorTest extends \PHPUnit_Framework_TestCase
{
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
     * Tests that invalid UUID's are rejected
     *
     * @covers \Profman\Catalog\Uuid\UuidValidator::isValid
     * @dataProvider badDataProvider
     */
    public function testValidationFailsForInvalidUuid($uuid)
    {
        $uuidValidator = new UuidValidator();
        $valid = $uuidValidator->isValid(['uuid' => $uuid]);
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
            $values[] = [$faker->uuid];
        }
        return $values;
    }

    /**
     * Tests that valid UUID's are accepted
     *
     * @covers \Profman\Catalog\Uuid\UuidValidator::isValid
     * @dataProvider goodDataProvider
     */
    public function testValidationSucceedsForValidUuid($uuid)
    {
        $uuidValidator = new UuidValidator();
        $valid = $uuidValidator->isValid(['uuid' => $uuid]);
        $this->assertTrue($valid, 'Can\'t validate UUID ' . $uuid);
    }
}