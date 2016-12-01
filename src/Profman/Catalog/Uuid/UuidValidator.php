<?php

namespace Profman\Catalog\Uuid;

use Profman\Catalog\ValidatorInterface;

class UuidValidator implements ValidatorInterface
{
    /**
     * @inheritDoc
     */
    public function isValid(array $data): bool
    {
        $matches = [];
        $regex = '/^([a-z0-9]{8})-([a-z0-9]{4})-([a-z0-9]{4})-([a-z0-9]{4})-([a-z0-9]{12})$/s';
        if (1 !== ($valid = preg_match($regex, $data['uuid'], $matches))) {
            return false;
        }
        return true;
    }
}
