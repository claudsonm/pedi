<?php

namespace Claudsonm\Pedi\Tests\Standards\PagSeguro\Enums;

use Claudsonm\Pedi\Tests\TestCase;
use Claudsonm\Pedi\Standards\PagSeguro\Enums\StatusPagamento;

class StatusPagamentoTest extends TestCase
{
    /** @test */
    public function it_retrieves_the_payment_statuses_that_indicate_available_values()
    {
        $statuses = StatusPagamento::disponivel();

        $this->assertContains(2, $statuses);
        $this->assertContains(3, $statuses);
        $this->assertContains(4, $statuses);
    }

    /** @test */
    public function it_retrieves_the_payment_statuses_that_indicate_unavailable_values()
    {
        $statuses = StatusPagamento::indisponivel();

        $this->assertContains(1, $statuses);
        $this->assertContains(5, $statuses);
    }
}
