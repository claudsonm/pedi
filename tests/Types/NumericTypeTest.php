<?php

namespace Claudsonm\Pedi\Tests\Types;

use Claudsonm\Pedi\Exceptions\PediException;
use Claudsonm\Pedi\Structure\Field;
use Claudsonm\Pedi\Structure\Types\Numeric;
use PHPUnit\Framework\TestCase;

class NumericTypeTest extends TestCase
{
    /** @test */
    public function it_can_verify_when_an_value_is_a_valid_integer()
    {
        $type = new Numeric();

        $this->assertFalse($type->isValidInput('letters'));
        $this->assertFalse($type->isValidInput('lettersand123'));
        $this->assertFalse($type->isValidInput('numbers&&special_chars!'));
        $this->assertTrue($type->isValidInput('123'));
    }

    /** @test */
    public function it_throws_exception_when_a_non_numeric_value_is_given()
    {
        $field = (new Field())->setType(new Numeric());

        $this->expectException(PediException::class);
        $this->expectExceptionMessage('The value `AB` is not compatible with the field');

        $field->setContent('AB');
    }

    /** @test */
    public function it_throws_exception_with_the_field_name_when_a_non_numeric_value_is_given()
    {
        $field = (new Field())->setType(new Numeric())->setName('My Field');

        $this->expectException(PediException::class);
        $this->expectExceptionMessage('The value `AB` is not compatible with the field My Field');

        $field->setContent('AB');
    }
}
