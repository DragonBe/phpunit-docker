<?php

namespace Profman\Profile;

use Profman\Catalog\Email\EmailValidator;
use Profman\Catalog\FactoryInterface;
use Profman\Catalog\Uuid\UuidValidator;

class MemberEmailFactory implements FactoryInterface
{
    /**
     * Creates a member email object with added uuid and email validators
     *
     * @return MemberEmail
     *
     * @covers \Profman\Profile\MemberEmailFactory::create
     */
    public static function create()
    {
        $uuidValidator = new UuidValidator();
        $emailValidator = new EmailValidator();
        return new MemberEmail([
            'uuid' => $uuidValidator,
            'email' => $emailValidator,
        ]);
    }
}
