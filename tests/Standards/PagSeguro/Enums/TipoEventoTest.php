<?php

namespace Claudsonm\Pedi\Tests\Standards\PagSeguro\Enums;

use Claudsonm\Pedi\Tests\TestCase;
use Claudsonm\Pedi\Standards\PagSeguro\Enums\TipoEvento;

class TipoEventoTest extends TestCase
{
    /** @test */
    public function it_retrieves_the_event_types_that_indicates_cash_in()
    {
        $cashInEvents = TipoEvento::entrada();

        $this->assertContains('01', $cashInEvents);
        $this->assertContains('02', $cashInEvents);
        $this->assertContains('07', $cashInEvents);
        $this->assertContains('08', $cashInEvents);
        $this->assertContains('10', $cashInEvents);
        $this->assertContains('12', $cashInEvents);
        $this->assertContains('16', $cashInEvents);
    }

    /** @test */
    public function it_retrieves_the_event_types_that_indicates_cash_out()
    {
        $cashOutEvents = TipoEvento::saida();

        $this->assertContains('03', $cashOutEvents);
        $this->assertContains('04', $cashOutEvents);
        $this->assertContains('05', $cashOutEvents);
        $this->assertContains('06', $cashOutEvents);
        $this->assertContains('09', $cashOutEvents);
        $this->assertContains('11', $cashOutEvents);
        $this->assertContains('14', $cashOutEvents);
    }
}
