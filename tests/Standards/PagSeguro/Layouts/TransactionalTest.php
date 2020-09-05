<?php

namespace Claudsonm\Pedi\Tests\Standards\PagSeguro\Layouts;

use Claudsonm\Pedi\Standards\PagSeguro\Layouts\Transacional;
use Claudsonm\Pedi\Standards\PagSeguro\Records\Header;
use Claudsonm\Pedi\Standards\PagSeguro\Records\Trailer;
use Claudsonm\Pedi\Tests\Support\PagSeguroTestHelpers;
use Claudsonm\Pedi\Tests\TestCase;

class TransactionalTest extends TestCase
{
    use PagSeguroTestHelpers;

    /**
     * @test
     * @dataProvider transactionalFilesDetails
     */
    public function it_parses_valid_pagseguro_transactional_edi_files(string $file, int $total, int $details)
    {
        $content = file_get_contents($file);

        $layout = new Transacional();
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
            [$basePath.'/00006C9FCB064523BC3444868D4BA89A/PAGSEG_987654321_TRANS_20180913_20180914_00201_01.txt', 12, 10],
            [$basePath.'/00006C9FCB064523BC3444868D4BA89A/PAGSEG_987654321_TRANS_20180904_20180905_00201_01.txt', 12, 10],
            [$basePath.'/028B7D600627490486DCF5DEDACB8C10/PAGSEG_987654321_TRANS_20181015_20181016_00201_01.txt', 5, 3],
            [$basePath.'/028B7D600627490486DCF5DEDACB8C10/PAGSEG_987654321_TRANS_20180908_20180909_00201_01.txt', 4, 2],
            [$basePath.'/4CF3D089C588488F87757CFB0891A099/PAGSEG_987654321_TRANS_20180922_20180923_00201_01.txt', 8, 6],
            [$basePath.'/4CF3D089C588488F87757CFB0891A099/PAGSEG_987654321_TRANS_20181009_20181010_00201_01.txt', 8, 6],
            [$basePath.'/CFF65BD3DA374ADD9B97AE63238F1182/PAGSEG_987654321_TRANS_20180728_20180729_00201_01.txt', 4, 2],
            [$basePath.'/2D296F86F069429C90DBA4C05357A569/PAGSEG_987654321_TRANS_20180729_20180730_00201_01.txt', 7, 5],
            [$basePath.'/2D296F86F069429C90DBA4C05357A569/PAGSEG_987654321_TRANS_20181005_20181006_00201_01.txt', 5, 3],
            [$basePath.'/DF7AC94DE4EA4F66BFE600C15E58B525/PAGSEG_987654321_TRANS_20181002_20181003_00201_01.txt', 4, 2],
            [$basePath.'/0110743A35634EDB958BBA40C21B67FB/PAGSEG_987654321_TRANS_20180924_20180925_00201_01.txt', 4, 2],
            [$basePath.'/6406516236A8410EB806EDB37A50A32A/PAGSEG_987654321_TRANS_20180918_20180919_00201_01.txt', 3, 1],
            [$basePath.'/21315F791ED143D48BD0C771C4C45C1C/PAGSEG_987654321_TRANS_20181029_20181030_00201_01.txt', 11, 9],
            [$basePath.'/21315F791ED143D48BD0C771C4C45C1C/PAGSEG_987654321_TRANS_20181018_20181019_00201_01.txt', 5, 3],
            [$basePath.'/4B494E619E6F46ABBF530F8588E8207A/PAGSEG_987654321_TRANS_20180808_20180809_00201_01.txt', 9, 7],
            [$basePath.'/4B494E619E6F46ABBF530F8588E8207A/PAGSEG_987654321_TRANS_20181018_20181019_00201_01.txt', 7, 5],
            [$basePath.'/13A3718FD46443078B93CF06937F60AD/PAGSEG_987654321_TRANS_20181005_20181006_00201_01.txt', 3, 1],
            [$basePath.'/13A3718FD46443078B93CF06937F60AD/PAGSEG_987654321_TRANS_20181027_20181028_00201_01.txt', 3, 1],
            [$basePath.'/13A3718FD46443078B93CF06937F60AD/PAGSEG_987654321_TRANS_20181006_20181007_00201_01.txt', 3, 1],
            [$basePath.'/046EC2AB1D0F452595B6ABFD7057F358/PAGSEG_987654321_TRANS_20180910_20180911_00201_01.txt', 8, 6],
        ];
    }
}
