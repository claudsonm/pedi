<?php

namespace Claudsonm\Pedi\Structure\Types;

use Claudsonm\Pedi\Exceptions\PediException;
use Claudsonm\Pedi\Structure\Field;

interface Type
{
    /**
     * Transform the field value from the underlying text value.
     *
     * @throws PediException
     */
    public function castFromLine(Field $field, $value);

    /**
     * Transform the field value to its underlying text value.
     */
    public function castToString(Field $field, $value): string;

    /**
     * Verifies if the given value is a valid input for the type.
     */
    public function isValidInput($value): bool;
}
