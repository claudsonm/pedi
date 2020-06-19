<?php

namespace Claudsonm\Pedi\Structure\Types;

use Claudsonm\Pedi\Structure\Field;

interface Type
{
    /**
     * Transform the field value from the underlying text value.
     */
    public function castFromLine(Field $field, $value);

    /**
     * Transform the field value to its underlying text value.
     */
    public function castToString(Field $field, $value): string;
}
