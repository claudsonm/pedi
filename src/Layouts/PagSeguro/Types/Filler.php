<?php

namespace Claudsonm\Pedi\Layouts\PagSeguro\Types;

use Claudsonm\Pedi\Structure\Types\AlphaNumeric;

class Filler extends AlphaNumeric
{
    /**
     * {@inheritdoc}
     */
    public function isValidInput($value): bool
    {
        return preg_match('/^A\s+$/', $value);
    }
}
