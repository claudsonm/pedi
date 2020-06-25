<?php

namespace Claudsonm\Pedi\Tests\Layouts\PagSeguro;

use Claudsonm\Pedi\Layouts\PagSeguro\Financeiro;
use Claudsonm\Pedi\Layouts\PagSeguro\Records\Header;
use Claudsonm\Pedi\Layouts\PagSeguro\Records\Trailer;
use Claudsonm\Pedi\Tests\TestCase;

class FinanceiroTest extends TestCase
{
    /**
     * @test
     * @dataProvider financialFilesDetails
     */
    public function it_parses_a_valid_file(string $file, int $total, int $details)
    {
        $content = file_get_contents($file);

        $layout = new Financeiro();
        $layout->parse($content);

        $this->assertSame($total, $layout->getTotalOfRecords());
        $this->assertInstanceOf(Header::class, $layout->getHeader());
        $this->assertInstanceOf(Trailer::class, $layout->getTrailer());
        $this->assertCount($details, $layout->getDetalhes());
    }

    public function financialFilesDetails(): array
    {
        $files = glob(__DIR__.'/../../Fixtures/pagseguro/2.01/**/*_FIN_*.txt', GLOB_NOSORT);
        $differentItems = [
            '/6406516236A8410EB806EDB37A50A32A/PAGSEG_987654321_FIN_20181012_20181013_00201_01.txt' => [
                'total' => 5,
                'details' => 3,
            ],
            '/6406516236A8410EB806EDB37A50A32A/PAGSEG_987654321_FIN_20180919_20180920_00201_01.txt' => [
                'total' => 4,
                'details' => 2,
            ],
        ];

        return array_map(function ($file) use ($differentItems) {
            $total = 3;
            $details = 1;
            foreach ($differentItems as $fileName => $info) {
                $endsWith = substr($file, strlen($file) - strlen($fileName));
                if ($endsWith === $fileName) {
                    $total = $info['total'];
                    $details = $info['details'];
                }
            }

            return [
                $file,
                $total,
                $details,
            ];
        }, $files);
    }
}
