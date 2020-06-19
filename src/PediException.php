<?php

namespace Claudsonm\Pedi;

use Exception;
use Claudsonm\Pedi\Structure\Field;

class PediException extends Exception
{
    public static function invalidInput(Field $field, $value): self
    {
        return new static("The value `{$value}` is not compatible with the field {$field->getName()}");
    }
}
