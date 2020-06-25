<?php

namespace Claudsonm\Pedi\Patterns\PagSeguro\Layouts;

use Claudsonm\Pedi\Patterns\PagSeguro\Layouts\LayoutPagSeguro;
use Claudsonm\Pedi\Patterns\PagSeguro\Records\DetalheTransacional;
use Claudsonm\Pedi\Patterns\PagSeguro\Records\Header;
use Claudsonm\Pedi\Patterns\PagSeguro\Records\Trailer;

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
