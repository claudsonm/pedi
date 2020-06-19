<?php

namespace Claudsonm\Pedi\Tests\Types;

use Claudsonm\Pedi\PediException;
use Claudsonm\Pedi\Structure\Field;
use Claudsonm\Pedi\Structure\Types\AlphaNumeric;
use PHPUnit\Framework\TestCase;

class AlphaNumericTypeTest extends TestCase
{
    /** @test */
    public function it_can_verify_when_an_value_is_a_valid_alphanumeric()
    {
        $type = new AlphaNumeric();

        $this->assertTrue($type->isValidInput('letters'));
        $this->assertTrue($type->isValidInput('lettersand123'));
        $this->assertFalse($type->isValidInput('numbers&&special_chars!'));
        $this->assertTrue($type->isValidInput('123'));
    }

    /** @test */
    public function it_throws_exception_when_a_non_alphanumeric_value_is_given()
    {
        $field = (new Field())->setType(new AlphaNumeric());

        $this->expectException(PediException::class);
        $this->expectExceptionMessage('The value `invalid_underscore` is not compatible with the field');

        $field->setContent('invalid_underscore');
    }

    /** @test */
    public function it_throws_exception_with_the_field_name_when_a_non_alphanumeric_value_is_given()
    {
        $field = (new Field())->setType(new AlphaNumeric())->setName('My Field');

        $this->expectException(PediException::class);
        $this->expectExceptionMessage('The value `invalid_underscore` is not compatible with the field My Field');

        $field->setContent('invalid_underscore');
    }
}
