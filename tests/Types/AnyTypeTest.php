<?php

namespace Claudsonm\Pedi\Tests\Types;

use Claudsonm\Pedi\Exceptions\PediException;
use Claudsonm\Pedi\Structure\Field;
use Claudsonm\Pedi\Structure\Types\Any;
use PHPUnit\Framework\TestCase;

class AnyTypeTest extends TestCase
{
    /** @test */
    public function it_accepts_any_type_of_entry()
    {
        $type = new Any();

        $this->assertTrue($type->isValidInput('letters'));
        $this->assertTrue($type->isValidInput('lettersand123'));
        $this->assertTrue($type->isValidInput('numbers&&special_chars!'));
        $this->assertTrue($type->isValidInput('123'));
        $this->assertTrue($type->isValidInput('-2'));
        $this->assertTrue($type->isValidInput('60.31'));
        $this->assertTrue($type->isValidInput('-456.1233,31'));
        $this->assertTrue($type->isValidInput('  this one have    spaces   '));
    }

    /** @test */
    public function it_rejects_line_breaks()
    {
        $type = new Any();

        $this->assertFalse($type->isValidInput("one\ntwo"));
    }

    /** @test */
    public function it_throws_exception_when_a_invalid_string_is_given()
    {
        $field = (new Field())->setType(new Any());

        $this->expectException(PediException::class);
        $this->expectExceptionMessage('The value `line\nbreaks` is not compatible with the field');

        $field->setContent("line\nbreaks");
    }

    /** @test */
    public function it_throws_exception_with_the_field_name_when_a_non_numeric_value_is_given()
    {
        $field = (new Field())->setType(new Any())->setName('My Field');

        $this->expectException(PediException::class);
        $this->expectExceptionMessage('The value `line\nbreaks` is not compatible with the field My Field');

        $field->setContent("line\nbreaks");
    }
}
