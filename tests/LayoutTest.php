<?php

namespace Claudsonm\Pedi\Tests;

use Claudsonm\Pedi\Structure\Field;
use Claudsonm\Pedi\Structure\Layout;
use Claudsonm\Pedi\Structure\Record;
use PHPUnit\Framework\TestCase;
use SplFileObject;
use SplTempFileObject;

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
        // $contents = file_get_contents(__DIR__.'/fixtures/dummy01.txt');
        $contents = file_get_contents(__DIR__.'/fixtures/pagseguro/2.01/6406516236A8410EB806EDB37A50A32A/PAGSEG_987654321_FIN_20180919_20180920_00201_01.txt');

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
