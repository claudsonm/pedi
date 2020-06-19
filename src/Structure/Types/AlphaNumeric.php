<?php

namespace Claudsonm\Pedi\Structure\Types;

use Claudsonm\Pedi\Structure\Field;

class AlphaNumeric implements Type
{
    /**
     * {@inheritdoc}
     */
    public function castFromLine(Field $field, $value)
    {
        return (string) $value;
    }

    /**
     * {@inheritdoc}
     */
    public function castToString(Field $field, $value): string
    {
        return (string) $value;
    }
}
