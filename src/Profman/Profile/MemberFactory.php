<?php

namespace Profman\Profile;

use Profman\Catalog\FactoryInterface;
use Profman\Catalog\Uuid\UuidValidator;

class MemberFactory implements FactoryInterface
{
    /**
     * Creates a new Member object with validation classes
     *
     * @return Member
     */
    public static function create()
    {
        $validators = [
            'uuid' => new UuidValidator(),
        ];
        return new Member($validators);
    }
}
