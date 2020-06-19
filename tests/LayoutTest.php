<?php

namespace Claudsonm\Pedi\Tests;

use SplFileObject;
use PHPUnit\Framework\TestCase;
use Claudsonm\Pedi\Structure\Field;
use Claudsonm\Pedi\Structure\Layout;
use Claudsonm\Pedi\Structure\Record;

class LayoutTest extends TestCase
{
    /** @test */
    public function it_creates_a_layout_and_retrieves_the_records()
    {
        $firstRecord = (new Record())
            ->add((new Field())->setSize(1)->setStart(1))
            ->add((new Field())->setSize(2)->setStart(2));
        $secondRecord = (new Record())
            ->add((new Field())->setSize(1)->setStart(1))
            ->add((new Field())->setSize(2)->setStart(2));

        $layout = (new Layout())->add($firstRecord)->add($secondRecord);

        $this->assertSame(2, $layout->getTotalOfRecords());
        $this->assertSame($firstRecord, $layout->getRecords()[0]);
        $this->assertSame($secondRecord, $layout->getRecords()[1]);
    }

    /** @test */
    public function handles_the_file()
    {
        $path = __DIR__.'/fixtures/dummy01.txt';
        $file = new SplFileObject($path);
        $file->setFlags(SplFileObject::DROP_NEW_LINE | SplFileObject::READ_AHEAD | SplFileObject::SKIP_EMPTY);

        while (! $file->eof()) {
            $line = $file->current();
            print_r(strlen($line));
            $file->next();
        }
    }
}
