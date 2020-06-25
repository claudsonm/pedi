<?php

namespace Claudsonm\Pedi\Standards\PagSeguro\Layouts;

use Claudsonm\Pedi\Standards\PagSeguro\Layouts\LayoutPagSeguro;
use Claudsonm\Pedi\Standards\PagSeguro\Records\DetalheTransacional;
use Claudsonm\Pedi\Standards\PagSeguro\Records\Header;
use Claudsonm\Pedi\Standards\PagSeguro\Records\Trailer;

class Transacional extends LayoutPagSeguro
{
    public function __construct()
    {
        $this->append(new Header())
            ->append(new DetalheTransacional(), '*')
            ->append(new Trailer());
    }

    /**
     * @return array|DetalheTransacional[]
     */
    public function getDetalhes(): array
    {
        return array_filter($this->getContents(), fn ($record) => $record instanceof DetalheTransacional);
    }
}
