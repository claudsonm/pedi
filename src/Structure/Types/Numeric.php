<?php

namespace Claudsonm\Pedi\Structure\Types;

use Claudsonm\Pedi\PediException;
use Claudsonm\Pedi\Structure\Field;

class Numeric implements Type
{
    /**
     * {@inheritdoc}
     */
    public function castFromLine(Field $field, $value)
    {
        if (! $this->isValidInput($value)) {
            throw PediException::invalidInput($field, $value);
        }

        return (int) $value;
    }

    /**
     * {@inheritdoc}
     */
    public function castToString(Field $field, $value): string
    {
        return str_pad($value, $field->getSize(), '0', STR_PAD_LEFT);
    }

    /**
     * {@inheritdoc}
     */
    public function isValidInput($value): bool
    {
        return preg_match('/^[0-9]+$/', $value);
    }
}
