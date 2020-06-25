<?php

namespace Claudsonm\Pedi\Layouts\PagSeguro\Records;

use Claudsonm\Pedi\Structure\Field;
use Claudsonm\Pedi\Structure\Types\Numeric;
use Claudsonm\Pedi\Structure\Types\Any;

class DetalheAntecipacao
{
    private array $definitions = [
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
            'name' => 'DATA_INICIAL_TRANSACAO',
        ],
        [
            'size' => 6,
            'start' => 20,
            'type' => Numeric::class,
            'name' => 'HORA_INICIAL_TRANSACAO',
        ],
        [
            'size' => 8,
            'start' => 26,
            'type' => Numeric::class,
            'name' => 'DATA_VENDA_AJUSTE',
        ],
        [
            'size' => 6,
            'start' => 34,
            'type' => Numeric::class,
            'name' => 'HORA_VENDA_AJUSTE',
        ],
        [
            'size' => 2,
            'start' => 40,
            'type' => Numeric::class,
            'name' => 'TIPO_EVENTO',
        ],
        [
            'size' => 2,
            'start' => 42,
            'type' => Numeric::class,
            'name' => 'TIPO_TRANSACAO',
        ],
        [
            'size' => 2,
            'start' => 44,
            'type' => Any::class,
            'name' => 'FILLER',
        ],
        [
            'size' => 32,
            'start' => 46,
            'type' => Any::class,
            'name' => 'CODIGO_TRANSACAO',
        ],
        [
            'size' => 20,
            'start' => 78,
            'type' => Any::class,
            'name' => 'CODIGO_VENDA',
        ],
        [
            'size' => 13,
            'start' => 98,
            'type' => Numeric::class,
            'name' => 'VALOR_TOTAL_TRANSACAO',
        ],
        [
            'size' => 13,
            'start' => 111,
            'type' => Numeric::class,
            'name' => 'VALOR_PARCELA',
        ],
        [
            'size' => 2,
            'start' => 124,
            'type' => Any::class,
            'name' => 'PLANO',
        ],
        [
            'size' => 2,
            'start' => 126,
            'type' => Any::class,
            'name' => 'PARCELA',
        ],
        [
            'size' => 2,
            'start' => 128,
            'type' => Numeric::class,
            'name' => 'QUANTIDADE_PARCELAS',
        ],
        [
            'size' => 8,
            'start' => 130,
            'type' => Numeric::class,
            'name' => 'DATA_PREVISTA_PAGAMENTO',
        ],
        [
            'size' => 8,
            'start' => 138,
            'type' => Numeric::class,
            'name' => 'DATA_MOVIMENTACAO',
        ],
        [
            'size' => 13,
            'start' => 146,
            'type' => Numeric::class,
            'name' => 'VALOR_LIQUIDO_TRANSACAO',
        ],
        [
            'size' => 13,
            'start' => 159,
            'type' => Numeric::class,
            'name' => 'TAXA_ANTECIPACAO',
        ],
        [
            'size' => 13,
            'start' => 172,
            'type' => Numeric::class,
            'name' => 'VALOR_LIQUIDO_ANTECIPACAO',
        ],
        [
            'size' => 2,
            'start' => 185,
            'type' => Numeric::class,
            'name' => 'STATUS_PAGAMENTO',
        ],
        [
            'size' => 32,
            'start' => 187,
            'type' => Any::class,
            'name' => 'NUM_LOGICO',
        ],
        [
            'size' => 14,
            'start' => 219,
            'type' => Any::class,
            'name' => 'NSU',
        ],
        [
            'size' => 6,
            'start' => 233,
            'type' => Any::class,
            'name' => 'CARTAO_BIN',
        ],
        [
            'size' => 4,
            'start' => 239,
            'type' => Any::class,
            'name' => 'CARTAO_HOLDER',
        ],
        [
            'size' => 6,
            'start' => 243,
            'type' => Any::class,
            'name' => 'CODIGO_AUTORIZACAO',
        ],
        [
            'size' => 32,
            'start' => 249,
            'type' => Any::class,
            'name' => 'CODIGO_CV',
        ],
        [
            'size' => 250,
            'start' => 281,
            'type' => Any::class,
            'name' => 'INTERNO_PAGSG',
        ],
    ];

    public function __construct()
    {
        foreach ($this->definitions as $definition) {
            $field = (new Field())
                ->setSize($definition['size'])
                ->setStart($definition['start'])
                ->setType(new $definition['type']())
                ->setName($definition['name']);
            $this->add($field);
        }
    }
}
