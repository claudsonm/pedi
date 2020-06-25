<?php

namespace Claudsonm\Pedi\Standards\PagSeguro\Layouts;

use Claudsonm\Pedi\Standards\PagSeguro\Layouts\LayoutPagSeguro;
use Claudsonm\Pedi\Standards\PagSeguro\Records\DetalheAntecipacao;
use Claudsonm\Pedi\Standards\PagSeguro\Records\Header;
use Claudsonm\Pedi\Standards\PagSeguro\Records\Trailer;

class Antecipacao extends LayoutPagSeguro
{
    public function __construct()
    {
        $this->append(new Header())
            ->append(new DetalheAntecipacao(), '*')
            ->append(new Trailer());
    }

    /**
     * @return array|DetalheAntecipacao[]
     */
    public function getDetalhes(): array
    {
        return array_filter($this->getContents(), fn ($record) => $record instanceof DetalheAntecipacao);
    }
}
