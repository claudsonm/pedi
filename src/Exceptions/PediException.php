<?php

namespace Claudsonm\Pedi\Exceptions;

use Claudsonm\Pedi\Structure\Field;
use Exception;

class PediException extends Exception
{
    public static function invalidInput(Field $field, $value): self
    {
        return new static("The value `{$value}` is not compatible with the field {$field->getName()}");
    }

    public static function invalidQuantifier()
    {
        return new static('Only integers higher than zero or the wildcard `*` are allowed as valid occurrences quantifiers.');
    }
}
