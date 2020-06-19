<?php

namespace Claudsonm\Pedi\Structure\Types;

use Claudsonm\Pedi\Structure\Field;

class Integer implements Type
{
    /**
     * {@inheritdoc}
     */
    public function castFromLine(Field $field, $value)
    {
        return (int) $value;
    }

    /**
     * {@inheritdoc}
     */
    public function castToString(Field $field, $value): string
    {
        return str_pad($value, $field->getSize(), '0', STR_PAD_LEFT);
    }
}
