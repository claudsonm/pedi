<?php

namespace Claudsonm\Pedi\Tests;

use Claudsonm\Pedi\Structure\Types\Numeric;
use Claudsonm\Pedi\Structure\Types\AlphaNumeric;
use Claudsonm\Pedi\Layouts\PagSeguro\Support\PagSeguroHelper;
use Claudsonm\Pedi\PediException;
use Claudsonm\Pedi\Structure\Layout;
use Claudsonm\Pedi\Structure\Record;
use SplFileObject;
use SplTempFileObject;

class LayoutTest extends TestCase
{
    use PagSeguroHelper;

    /** @test */
    public function it_can_append_records_into_the_layout_structure()
    {
        $layout = new Layout();

        $this->assertEmpty($layout->getStructure());

        $layout->append(new Record());
        $layout->append(new Record());

        $this->assertNotEmpty($layout->getStructure());
        $this->assertCount(2, $layout->getStructure());
    }

    /** @test */
    public function it_accepts_integers_as_quantifiers()
    {
        $layout = new Layout();

        $layout->append($first = new Record(), 6);
        [$record, $quantifier] = $layout->getStructure()[0];

        $this->assertSame($first, $record);
        $this->assertSame(6, $quantifier);
    }

    /** @test */
    public function it_translates_integer_strings_quantifiers_into_the_proper_values()
    {
        $layout = new Layout();

        $layout->append($first = new Record(), '4');
        [$record, $quantifier] = $layout->getStructure()[0];

        $this->assertSame($first, $record);
        $this->assertSame(4, $quantifier);
    }

    /** @test */
    public function it_translates_wildcard_quantifiers_into_the_proper_value()
    {
        $layout = new Layout();

        $layout->append($first = new Record(), '*');
        [$record, $quantifier] = $layout->getStructure()[0];

        $this->assertSame($first, $record);
        $this->assertSame(-1, $quantifier);
    }

    /**
     * @test
     * @dataProvider invalidQuantifiers
     */
    public function it_throws_exception_if_the_given_quantifier_is_invalid($times)
    {
        $this->expectException(PediException::class);
        $this->expectExceptionMessage('Only integers higher than zero or the wildcard `*` are allowed as valid occurrences quantifiers.');

        (new Layout())->append(new Record(), $times);
    }

    /** @test */
    public function it_can_read_the_contents_of_a_file_into_a_layout_instance()
    {
        $definition = [
            [
                'size' => 1,
                'start' => 1,
                'type' => Numeric::class,
            ],
            [
                'size' => 4,
                'start' => 2,
                'type' => AlphaNumeric::class,
            ]
        ];
        $numberAndFourLetters = $this->makeRecord($definition);

        $layout = new Layout();
        $layout->append($numberAndFourLetters);
        $layout->parse('1ABC');

        $this->assertSame(1, $layout->getTotalOfRecords());
    }

    public function invalidQuantifiers()
    {
        return [
            ['0'],
            [0],
            [-1],
            ['a'],
            ['05'],
        ];
    }

    /** @test */
    public function handles_the_file()
    {
        // $contents = file_get_contents(__DIR__.'/fixtures/dummy01.txt');
        $contents = file_get_contents(__DIR__.'/Fixtures/pagseguro/2.01/6406516236A8410EB806EDB37A50A32A/PAGSEG_987654321_FIN_20180919_20180920_00201_01.txt');

        $file = new SplTempFileObject();
        $file->setFlags(SplFileObject::DROP_NEW_LINE);
        $file->fwrite($contents);
        $file->rewind();

        while ($file->valid()) {
            $line = $file->getCurrentLine();
            $endOfCurrentLine = $file->ftell();

            // var_dump('ATUAL', $line);
            // -----------
            try {
                $nextLine = $file->getCurrentLine();
            } catch (\RuntimeException $exception) {
                break;
            }
            // var_dump('NEXT', $nextLine);
            // -----------
            $file->fseek($endOfCurrentLine);
        }

        $this->assertTrue(true);
    }
}
