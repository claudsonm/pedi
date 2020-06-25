<?php

namespace Claudsonm\Pedi\Structure\Types;

use Claudsonm\Pedi\Exceptions\PediException;
use Claudsonm\Pedi\Structure\Field;

class Any implements Type
{
    /**
     * {@inheritdoc}
     */
    public function castFromLine(Field $field, $value)
    {
        if (! $this->isValidInput($value)) {
            throw PediException::invalidInput($field, str_replace("\n", '\n', $value));
        }

        return (string) $value;
    }

    /**
     * {@inheritdoc}
     */
    public function castToString(Field $field, $value): string
    {
        return (string) $value;
    }

    /**
     * {@inheritdoc}
     */
    public function isValidInput($value): bool
    {
        return preg_match('/^.*$/', $value);
    }
}
