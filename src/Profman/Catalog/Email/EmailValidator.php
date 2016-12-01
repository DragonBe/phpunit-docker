<?php

namespace Profman\Catalog\Email;

use Profman\Catalog\ValidatorInterface;

class EmailValidator implements ValidatorInterface
{
    /**
     * @inheritDoc
     */
    public function isValid(array $data): bool
    {
        if (!array_key_exists('email', $data)) {
            return false;
        }
        $valid = filter_var($data['email'], FILTER_VALIDATE_EMAIL);
        if (false === $valid) {
            return false;
        }
        return true;
    }
}
