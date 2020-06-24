<?php

namespace Claudsonm\Pedi\Layouts\PagSeguro;

use Claudsonm\Pedi\Structure\Layout;
use Claudsonm\Pedi\Layouts\PagSeguro\Records\Header;
use Claudsonm\Pedi\Layouts\PagSeguro\Records\Trailer;
use Claudsonm\Pedi\Layouts\PagSeguro\Records\DetalheFinanceiro;

class Financeiro extends Layout
{

    public function __construct()
    {
        $this->append(new Header())
            ->append(new DetalheFinanceiro(), '*')
            ->append(new Trailer());
    }
}
