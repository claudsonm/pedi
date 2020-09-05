<?php

namespace Claudsonm\Pedi\Tests\Standards\PagSeguro\Records;

use Claudsonm\Pedi\Tests\TestCase;
use Claudsonm\Pedi\Standards\PagSeguro\Records\Header;

class HeaderTest extends TestCase
{
    private Header $header;

    protected function setUp(): void
    {
        parent::setUp();

        $this->header = new Header();
        $this->header->parse('009876543212018101320181012201810120017816PAGSG02A                    002.01                                                                                                                                                                                                                                                                                                                                                                                                                                                                      ');
    }

    /** @test */
    public function it_can_get_the_establishment_from_the_header()
    {
        $this->assertSame(20181013, $this->header->getEstabelecimento());
    }

    /** @test */
    public function it_checks_if_the_contents_indicates_a_header_register()
    {
        $this->assertTrue($this->header->matches('0098765432120181013201810...'));
    }
}
