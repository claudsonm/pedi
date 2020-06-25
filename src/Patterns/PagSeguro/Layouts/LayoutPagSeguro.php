<?php

namespace Claudsonm\Pedi\Patterns\PagSeguro\Layouts;

use Claudsonm\Pedi\Patterns\PagSeguro\Records\Header;
use Claudsonm\Pedi\Patterns\PagSeguro\Records\Trailer;
use Claudsonm\Pedi\Structure\Layout;

abstract class LayoutPagSeguro extends Layout
{
    public function getHeader(): Header
    {
        return $this->getContents()[0];
    }

    public function getTrailer(): Trailer
    {
        $lastIndex = $this->getTotalOfRecords() - 1;

        return $this->getContents()[$lastIndex];
    }

    abstract public function getDetalhes(): array;
}
