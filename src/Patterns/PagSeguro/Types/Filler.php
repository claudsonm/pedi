<?php

namespace Claudsonm\Pedi\Patterns\PagSeguro\Types;

use Claudsonm\Pedi\Structure\Types\Any;

class Filler extends Any
{
    /**
     * {@inheritdoc}
     */
    public function isValidInput($value): bool
    {
        return preg_match('/^A\s+$/', $value);
    }
}
