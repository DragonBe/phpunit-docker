<?php

namespace Profman\Test\Profile;


use Profman\Profile\MemberEmail;
use Profman\Profile\MemberEmailFactory;

/**
 * Class MemberEmailFactoryTest
 *
 * @package Profman\Test\Profile
 * @group Member
 */
class MemberEmailFactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test creation of Member email object through factory
     *
     * @covers \Profman\Profile\MemberEmailFactory::create
     */
    public function testFactoryCreatesNewObject()
    {
        $memberEmail = MemberEmailFactory::create();
        $this->assertInstanceOf(MemberEmail::class, $memberEmail);
    }
}