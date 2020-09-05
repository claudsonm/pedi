<?php

namespace Claudsonm\Pedi\Tests\Standards\PagSeguro\Records;

use Claudsonm\Pedi\Tests\TestCase;
use Claudsonm\Pedi\Standards\PagSeguro\Records\Saldo;

class SaldoTest extends TestCase
{
    /** @test */
    public function it_checks_if_the_contents_indicates_a_saldo_register()
    {
        $saldo = new Saldo();

        $this->assertTrue($saldo->matches('244e3a'));
    }
}
