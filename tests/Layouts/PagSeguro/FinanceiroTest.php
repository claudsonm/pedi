<?php

namespace Claudsonm\Pedi\Tests\Layouts\PagSeguro;

use Claudsonm\Pedi\Tests\TestCase;
use Claudsonm\Pedi\Layouts\PagSeguro\Financeiro;

class FinanceiroTest extends TestCase
{
    /** @test */
    public function cool()
    {
        $path = __DIR__.'/../../Fixtures/pagseguro/2.01/2D296F86F069429C90DBA4C05357A569/PAGSEG_987654321_FIN_20180929_20180930_00201_01.txt';
        $content = file_get_contents($path);

        $layout = new Financeiro();
        $layout->parse($content);

        $this->assertSame(3, $layout->getTotalOfRecords());
    }
}
