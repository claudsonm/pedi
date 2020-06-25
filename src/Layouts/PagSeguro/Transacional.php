<?php

namespace Claudsonm\Pedi\Layouts\PagSeguro;

use Claudsonm\Pedi\Layouts\PagSeguro\Records\DetalheTransacional;
use Claudsonm\Pedi\Layouts\PagSeguro\Records\Header;
use Claudsonm\Pedi\Layouts\PagSeguro\Records\Trailer;

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
