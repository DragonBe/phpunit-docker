<?php

namespace Profman\Test\Profile;


use Profman\Profile\Member;
use Profman\Profile\MemberFactory;

/**
 * Class MemberFactoryTest
 *
 * @package Profman\Test\Profile
 * @group Member
 */
class MemberFactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test creation of Member object throug factory
     *
     * @covers \Profman\Profile\MemberFactory::create
     */
    public function testFactoryCreatesNewObject()
    {
        $member = MemberFactory::create();
        $this->assertInstanceOf(Member::class, $member);
    }
}