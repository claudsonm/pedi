<?php

namespace Claudsonm\Pedi\Patterns\PagSeguro\Layouts;

use Claudsonm\Pedi\Patterns\PagSeguro\Layouts\LayoutPagSeguro;
use Claudsonm\Pedi\Patterns\PagSeguro\Records\DetalheFinanceiro;
use Claudsonm\Pedi\Patterns\PagSeguro\Records\Header;
use Claudsonm\Pedi\Patterns\PagSeguro\Records\Trailer;

class Financeiro extends LayoutPagSeguro
{
    public function __construct()
    {
        $this->append(new Header())
            ->append(new DetalheFinanceiro(), '*')
            ->append(new Trailer());
    }

    /**
     * @return array|DetalheFinanceiro[]
     */
    public function getDetalhes(): array
    {
        return array_filter($this->getContents(), fn ($record) => $record instanceof DetalheFinanceiro);
    }
}
