<?php

namespace Claudsonm\Pedi\Tests\Standards\PagSeguro\Records;

use Claudsonm\Pedi\Tests\TestCase;
use Claudsonm\Pedi\Standards\PagSeguro\Records\Trailer;

class TrailerTest extends TestCase
{
    /** @test */
    public function it_checks_if_the_contents_indicates_a_trailer_register()
    {
        $trailer = new Trailer();
        $this->assertTrue($trailer->matches('900000000003...'));
    }
}
