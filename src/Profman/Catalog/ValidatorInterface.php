<?php

namespace Profman\Catalog;

interface ValidatorInterface
{
    /**
     * Checks if the given data is valid
     *
     * @param array $data
     * @return bool
     */
    public function isValid(array $data): bool;
}
