<?php

namespace Claudsonm\Pedi\Tests;

use Claudsonm\Pedi\Exceptions\PediException;
use Claudsonm\Pedi\Structure\Layout;
use Claudsonm\Pedi\Structure\Record;
use Claudsonm\Pedi\Structure\Types\Any;
use Claudsonm\Pedi\Structure\Types\Numeric;

class LayoutTest extends TestCase
{
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
    public function it_accepts_wildcard_as_occurrence()
    {
        $layout = new Layout();

        $layout->append($first = new Record(), '*');
        [$record, $quantifier] = $layout->getStructure()[0];

        $this->assertSame($first, $record);
        $this->assertSame('*', $quantifier);
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
    public function it_parses_a_single_record_layout()
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
                'type' => Any::class,
            ],
        ];
        $layout = new Layout();
        $layout->append($this->makeRecord($definition));

        $layout->parse('4ABC');

        $record = $layout->getContents()[0];
        $this->assertSame(1, $layout->getTotalOfRecords());
        $this->assertSame('4ABC', $record->getLineContent());
    }

    /** @test */
    public function it_parses_a_multi_record_layout()
    {
        $firstDefinition = [
            [
                'size' => 1,
                'start' => 1,
                'type' => Numeric::class,
            ],
            [
                'size' => 4,
                'start' => 2,
                'type' => Any::class,
            ],
        ];
        $secondDefinition = [
            [
                'size' => 2,
                'start' => 1,
                'type' => Any::class,
            ],
            [
                'size' => 4,
                'start' => 3,
                'type' => Numeric::class,
            ],
        ];
        $layout = new Layout();
        $layout->append($this->makeRecord($firstDefinition));
        $layout->append($this->makeRecord($secondDefinition));

        $input = <<<'FILE'
        4ABC
        xD0123
        FILE;
        $layout->parse($input);

        $this->assertSame(2, $layout->getTotalOfRecords());
        $this->assertSame('4ABC', $layout->getContents()[0]->getLineContent());
        $this->assertSame('xD0123', $layout->getContents()[1]->getLineContent());
    }

    /** @test */
    public function it_parses_a_single_record_layout_with_quantifiers()
    {
        $definition = [
            [
                'size' => 2,
                'start' => 1,
                'type' => Any::class,
            ],
            [
                'size' => 4,
                'start' => 3,
                'type' => Numeric::class,
            ],
        ];
        $layout = new Layout();
        $layout->append($this->makeRecord($definition), 3);

        $input = <<<'FILE'
        xD0123
        8D9987
        wm3147
        FILE;
        $layout->parse($input);

        $this->assertSame(3, $layout->getTotalOfRecords());
        $this->assertSame('xD0123', $layout->getContents()[0]->getLineContent());
        $this->assertSame('8D9987', $layout->getContents()[1]->getLineContent());
        $this->assertSame('wm3147', $layout->getContents()[2]->getLineContent());
    }

    /** @test */
    public function it_parses_a_multi_record_layout_with_quantifiers()
    {
        $firstDefinition = [
            [
                'size' => 2,
                'start' => 1,
                'type' => Any::class,
            ],
            [
                'size' => 4,
                'start' => 3,
                'type' => Numeric::class,
            ],
        ];
        $secondDefinition = [
            [
                'size' => 4,
                'start' => 1,
                'type' => Numeric::class,
            ],
            [
                'size' => 6,
                'start' => 5,
                'type' => Any::class,
            ],
        ];
        $layout = new Layout();
        $layout->append($this->makeRecord($firstDefinition), 3);
        $layout->append($this->makeRecord($secondDefinition), 2);

        $input = <<<'FILE'
        AA1111
        BB2222
        CC3333
        4444DDDDDD
        5555EEEEEE
        FILE;
        $layout->parse($input);

        $this->assertSame(5, $layout->getTotalOfRecords());
        $this->assertSame('AA1111', $layout->getContents()[0]->getLineContent());
        $this->assertSame('BB2222', $layout->getContents()[1]->getLineContent());
        $this->assertSame('CC3333', $layout->getContents()[2]->getLineContent());
        $this->assertSame('4444DDDDDD', $layout->getContents()[3]->getLineContent());
        $this->assertSame('5555EEEEEE', $layout->getContents()[4]->getLineContent());
    }

    /** @test */
    public function it_parses_a_multi_record_layout_with_wildcard_quantifiers()
    {
        $firstDefinition = [
            [
                'size' => 2,
                'start' => 1,
                'type' => Any::class,
            ],
            [
                'size' => 4,
                'start' => 3,
                'type' => Numeric::class,
            ],
        ];
        $secondDefinition = [
            [
                'size' => 4,
                'start' => 1,
                'type' => Numeric::class,
            ],
            [
                'size' => 6,
                'start' => 5,
                'type' => Any::class,
            ],
        ];
        $layout = new Layout();
        $layout->append($this->makeRecord($firstDefinition), '*');
        $layout->append($this->makeRecord($secondDefinition), 2);

        $input = <<<'FILE'
        AA1111
        BB2222
        CC3333
        4444DDDDDD
        5555EEEEEE
        FILE;
        $layout->parse($input);

        $this->assertSame(5, $layout->getTotalOfRecords());
        $this->assertSame('AA1111', $layout->getContents()[0]->getLineContent());
        $this->assertSame('BB2222', $layout->getContents()[1]->getLineContent());
        $this->assertSame('CC3333', $layout->getContents()[2]->getLineContent());
        $this->assertSame('4444DDDDDD', $layout->getContents()[3]->getLineContent());
        $this->assertSame('5555EEEEEE', $layout->getContents()[4]->getLineContent());
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
}
