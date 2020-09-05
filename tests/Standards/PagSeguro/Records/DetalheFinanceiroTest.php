<?php

namespace Claudsonm\Pedi\Tests\Standards\PagSeguro\Records;

use Claudsonm\Pedi\Tests\TestCase;
use Claudsonm\Pedi\Standards\PagSeguro\Records\DetalheFinanceiro;

class DetalheFinanceiroTest extends TestCase
{
    private DetalheFinanceiro $detail;

    protected function setUp(): void
    {
        parent::setUp();

        $line = '1098765432120180917203617201810120215461001  6406516236A8410EB806EDB37A50A32A57575777            00000000249000000000024505U1 0 00201810120000000000000000000000000000000000249000000000000000000000000029500000000000000000000000100000000000000000000000245050000000000000000000000000003  02BOLETO                        W 0003000000';
        $this->detail = new DetalheFinanceiro();
        $this->detail->parse($line);
    }

    /** @test */
    public function it_can_get_the_establishment_from_the_financial_detail()
    {
        $this->assertSame('0987654321', $this->detail->getEstabelecimento());
    }

    /** @test */
    public function it_can_get_the_event_type_from_the_financial_detail()
    {
        $this->assertSame('10', $this->detail->getTipoEvento());
    }

    /** @test */
    public function it_can_get_the_transaction_type_from_the_financial_detail()
    {
        $this->assertSame('01', $this->detail->getTipoTransacao());
    }

    /** @test */
    public function it_can_get_the_total_value_from_the_financial_detail()
    {
        $this->assertSame(24900, $this->detail->getValorTotal());
    }

    /** @test */
    public function it_can_get_the_original_value_from_the_financial_detail()
    {
        $this->assertSame(24900, $this->detail->getValorOriginal());
    }

    /** @test */
    public function it_can_get_the_liquid_value_from_the_financial_detail()
    {
        $this->assertSame(24505, $this->detail->getValorLiquido());
    }

    /** @test */
    public function it_can_get_the_payment_status_from_the_financial_detail()
    {
        $this->assertSame(3, $this->detail->getStatusPagamento());
    }
}
