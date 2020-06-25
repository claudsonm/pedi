<?php

namespace Claudsonm\Pedi\Layouts\PagSeguro;

use Claudsonm\Pedi\Layouts\PagSeguro\Records\Header;
use Claudsonm\Pedi\Layouts\PagSeguro\Records\Trailer;
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
