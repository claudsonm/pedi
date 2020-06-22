<?php

namespace Claudsonm\Pedi\Layouts\PagSeguro\Support;

use Claudsonm\Pedi\Structure\Record;
use Claudsonm\Pedi\Support\LayoutHelpers;
use Claudsonm\Pedi\Structure\Types\Numeric;
use Claudsonm\Pedi\Structure\Types\AlphaNumeric;

trait PagSeguroHelper
{
    use LayoutHelpers;

    public function makePagSeguroHeaderRecord(): Record
    {
        $definitions = [
            [
                'size' => 1,
                'start' => 1,
                'type' => Numeric::class,
                'name' => 'TIPO_REGISTRO',
            ],
            [
                'size' => 10,
                'start' => 2,
                'type' => Numeric::class,
                'name' => 'ESTABELECIMENTO',
            ],
            [
                'size' => 8,
                'start' => 12,
                'type' => Numeric::class,
                'name' => 'DATA_PROCESSAMENTO',
            ],
            [
                'size' => 8,
                'start' => 20,
                'type' => Numeric::class,
                'name' => 'DATA_INICIO',
            ],
            [
                'size' => 8,
                'start' => 28,
                'type' => Numeric::class,
                'name' => 'DATA_FIM',
            ],
            [
                'size' => 7,
                'start' => 36,
                'type' => Numeric::class,
                'name' => 'SEQUENCIA_ARQUIVO',
            ],
            [
                'size' => 5,
                'start' => 43,
                'type' => AlphaNumeric::class,
                'name' => 'ADQUIRENTE',
            ],
            [
                'size' => 2,
                'start' => 48,
                'type' => Numeric::class,
                'name' => 'TIPO_EXTRATO',
            ],
            [
                'size' => 21,
                'start' => 50,
                'type' => AlphaNumeric::class,
                'name' => 'FILLER',
            ],
            [
                'size' => 3,
                'start' => 71,
                'type' => AlphaNumeric::class,
                'name' => 'VERSAO_LAYOUT',
            ],
            [
                'size' => 3,
                'start' => 74,
                'type' => AlphaNumeric::class,
                'name' => 'VERSAO_RELEASE',
            ],
            [
                'size' => 454,
                'start' => 77,
                'type' => AlphaNumeric::class,
                'name' => 'INTERNO_PAGSG',
            ],
        ];
        return $this->makeRecord($definitions);
    }

    public function makePagSeguroTrailerRecord(): Record
    {
        $definitions = [
            [
                'size' => 1,
                'start' => 1,
                'type' => Numeric::class,
                'name' => 'TIPO_REGISTRO',
            ],
            [
                'size' => 11,
                'start' => 2,
                'type' => Numeric::class,
                'name' => 'QUANTIDADE_REGISTROS',
            ],
            [
                'size' => 518,
                'start' => 13,
                'type' => AlphaNumeric::class,
                'name' => 'INTERNO_PAGSG',
            ],
        ];
        return $this->makeRecord($definitions);
    }

    public function makePagSeguroSaldoRecord(): Record
    {
        $definitions = [
            [
                'size' => 1,
                'start' => 1,
                'type' => Numeric::class,
                'name' => 'TIPO_REGISTRO',
            ],
            [
                'size' => 10,
                'start' => 2,
                'type' => Numeric::class,
                'name' => 'ESTABELECIMENTO',
            ],
            [
                'size' => 8,
                'start' => 12,
                'type' => Numeric::class,
                'name' => 'DATA_MOVIMENTACAO',
            ],
            [
                'size' => 2,
                'start' => 20,
                'type' => Numeric::class,
                'name' => 'TIPO_EVENTO',
            ],
            [
                'size' => 13,
                'start' => 22,
                'type' => Numeric::class,
                'name' => 'VALOR_SALDO',
            ],
        ];
        return $this->makeRecord($definitions);
    }
}
