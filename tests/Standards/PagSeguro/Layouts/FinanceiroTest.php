<?php

namespace Claudsonm\Pedi\Tests\Standards\PagSeguro\Layouts;

use Claudsonm\Pedi\Standards\PagSeguro\Layouts\Financeiro;
use Claudsonm\Pedi\Standards\PagSeguro\Records\Header;
use Claudsonm\Pedi\Standards\PagSeguro\Records\Trailer;
use Claudsonm\Pedi\Tests\Support\PagSeguroTestHelpers;
use Claudsonm\Pedi\Tests\TestCase;

class FinanceiroTest extends TestCase
{
    use PagSeguroTestHelpers;

    /**
     * @test
     * @dataProvider financialFilesDetails
     */
    public function it_parses_valid_pagseguro_financial_edi_files(string $file, int $total, int $details)
    {
        $content = file_get_contents($file);

        $layout = new Financeiro();
        $layout->parse($content);

        $this->assertSame($total, $layout->getTotalOfRecords());
        $this->assertInstanceOf(Header::class, $header = $layout->getHeader());
        $this->assertInstanceOf(Trailer::class, $trailer = $layout->getTrailer());
        $this->assertCount($details, $layout->getDetalhes());
        $this->assertSame(1, $header->getLineNumber());
    }

    public function financialFilesDetails(): array
    {
        $files = glob(test_path('Fixtures/pagseguro/2.01/**/*_FIN_*.txt'), GLOB_NOSORT);
        $differentItems = [
            '/6406516236A8410EB806EDB37A50A32A/PAGSEG_987654321_FIN_20181012_20181013_00201_01.txt' => [
                'total' => 5,
                'details' => 3,
            ],
            '/6406516236A8410EB806EDB37A50A32A/PAGSEG_987654321_FIN_20180919_20180920_00201_01.txt' => [
                'total' => 4,
                'details' => 2,
            ],
            '/others/PG0001_PAGSEG_145822552_FIN_20200904_20200905_00201_01.txt' => [
                'total' => 20,
                'details' => 16,
            ],
        ];

        return $this->provideFileDetails($files, $differentItems);
    }
}
