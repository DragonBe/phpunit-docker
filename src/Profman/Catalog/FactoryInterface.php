<?php

namespace Profman\Catalog;

interface FactoryInterface
{
    /**
     * Creates a new object based on the defined type
     *
     * @return mixed
     */
    public static function create();
}
