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

        $this->assertTrue($saldo->matches('2014582255220200904070000000000000'));
        $this->assertTrue($saldo->matches('2014582255220200904080000000155127'));
    }

    /** @test */
    public function it_can_get_the_balance_value()
    {
        $saldo = new Saldo();
        $saldo->parse('2014582255220200904070000000000000');
        $this->assertSame(0.0, $saldo->getValor());

        $saldo->parse('2014582255220200904080000000155127');
        $this->assertSame(1551.27, $saldo->getValor());
    }

    /** @test */
    public function it_can_get_the_date_for_the_register()
    {
        $saldo = new Saldo();
        $saldo->parse('2014582255220200904070000000000000');
        $this->assertSame('2020-09-04', $saldo->getDataMovimentacao()->format('Y-m-d'));

        $saldo->parse('2014582255220200904080000000155127');
        $this->assertSame('2020-09-04', $saldo->getDataMovimentacao()->format('Y-m-d'));
    }
}
