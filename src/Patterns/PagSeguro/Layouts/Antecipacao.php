<?php

namespace Claudsonm\Pedi\Patterns\PagSeguro\Layouts;

use Claudsonm\Pedi\Patterns\PagSeguro\Layouts\LayoutPagSeguro;
use Claudsonm\Pedi\Patterns\PagSeguro\Records\DetalheAntecipacao;
use Claudsonm\Pedi\Patterns\PagSeguro\Records\Header;
use Claudsonm\Pedi\Patterns\PagSeguro\Records\Trailer;

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
