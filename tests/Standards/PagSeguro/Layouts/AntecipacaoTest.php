<?php

namespace Claudsonm\Pedi\Tests\Standards\PagSeguro\Layouts;

use Claudsonm\Pedi\Standards\PagSeguro\Layouts\Antecipacao;
use Claudsonm\Pedi\Standards\PagSeguro\Records\Header;
use Claudsonm\Pedi\Standards\PagSeguro\Records\Trailer;
use Claudsonm\Pedi\Tests\TestCase;

class AntecipacaoTest extends TestCase
{
    /**
     * @test
     * @dataProvider transactionalFilesDetails
     */
    public function it_parses_valid_pagseguro_anticipation_edi_files(string $file, int $total, int $details)
    {
        $content = file_get_contents($file);

        $layout = new Antecipacao();
        $layout->parse($content);

        $this->assertSame($total, $layout->getTotalOfRecords());
        $this->assertInstanceOf(Header::class, $header = $layout->getHeader());
        $this->assertInstanceOf(Trailer::class, $trailer = $layout->getTrailer());
        $this->assertCount($details, $layout->getDetalhes());
        $this->assertSame(1, $header->getLineNumber());
        $this->assertSame($details + 2, $trailer->getLineNumber());
    }

    public function transactionalFilesDetails(): array
    {
        $basePath = test_path('Fixtures/pagseguro/2.01');

        return [
            [$basePath.'/0110743A35634EDB958BBA40C21B67FB/PAGSEG_987654321_ANT_20180924_20180925_00201_01.txt', 4, 2],
            [$basePath.'/046EC2AB1D0F452595B6ABFD7057F358/PAGSEG_987654321_ANT_20180910_20180911_00201_01.txt', 5, 3],
        ];
    }
}
