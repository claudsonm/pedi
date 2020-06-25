<?php

namespace Claudsonm\Pedi\Tests\Layouts\PagSeguro;

use Claudsonm\Pedi\Tests\TestCase;
use Claudsonm\Pedi\Layouts\PagSeguro\Financeiro;
use Claudsonm\Pedi\Layouts\PagSeguro\Transacional;
use Claudsonm\Pedi\Layouts\PagSeguro\Records\Header;
use Claudsonm\Pedi\Layouts\PagSeguro\Records\Trailer;

class TransactionalTest extends TestCase
{
    /** @test */
    public function it_parses_valid_pagseguro_transactional_edi_files()
    {
        $content = file_get_contents(__DIR__.'/../../Fixtures/pagseguro/2.01/6406516236A8410EB806EDB37A50A32A/PAGSEG_987654321_TRANS_20180918_20180919_00201_01.txt');

        $layout = new Transacional();
        $layout->parse($content);

        $this->assertSame(3, $layout->getTotalOfRecords());
        $this->assertInstanceOf(Header::class, $layout->getHeader());
        $this->assertInstanceOf(Trailer::class, $layout->getTrailer());
        $this->assertCount(1, $layout->getDetalhes());
    }
}
