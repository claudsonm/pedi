<?php

namespace Claudsonm\Pedi\Layouts\PagSeguro\Records;

use Claudsonm\Pedi\Structure\Field;
use Claudsonm\Pedi\Structure\Record;
use Claudsonm\Pedi\Structure\Types\Numeric;
use Claudsonm\Pedi\Structure\Types\AlphaNumeric;

class DetalheFinanceiro extends Record
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
            'type' => AlphaNumeric::class,
            'name' => 'FILLER',
        ],
        [
            'size' => 32,
            'start' => 46,
            'type' => AlphaNumeric::class,
            'name' => 'CODIGO_TRANSACAO',
        ],
        [
            'size' => 20,
            'start' => 78,
            'type' => AlphaNumeric::class,
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
            'size' => 1,
            'start' => 124,
            'type' => AlphaNumeric::class,
            'name' => 'PAGAMENTO_PRAZO',
        ],
        [
            'size' => 2,
            'start' => 125,
            'type' => AlphaNumeric::class,
            'name' => 'PLANO',
        ],
        [
            'size' => 2,
            'start' => 127,
            'type' => AlphaNumeric::class,
            'name' => 'PARCELA',
        ],
        [
            'size' => 2,
            'start' => 129,
            'type' => Numeric::class,
            'name' => 'QUANTIDADE_PARCELAS',
        ],
        [
            'size' => 8,
            'start' => 131,
            'type' => Numeric::class,
            'name' => 'DATA_MOVIMENTACAO',
        ],
        [
            'size' => 13,
            'start' => 139,
            'type' => Numeric::class,
            'name' => 'TAXA_PARCELA_COMPRADOR',
        ],
        [
            'size' => 13,
            'start' => 152,
            'type' => Numeric::class,
            'name' => 'TARIFA_BOLETO_COMPRA',
        ],
        [
            'size' => 13,
            'start' => 165,
            'type' => Numeric::class,
            'name' => 'VALOR_ORIGINAL_TRANSACAO',
        ],
        [
            'size' => 13,
            'start' => 178,
            'type' => Numeric::class,
            'name' => 'TAXA_PARCELA_VENDEDOR',
        ],
        [
            'size' => 13,
            'start' => 191,
            'type' => Numeric::class,
            'name' => 'TAXA_INTERMEDIACAO',
        ],
        [
            'size' => 13,
            'start' => 204,
            'type' => Numeric::class,
            'name' => 'TARIFA_INTERMEDIACAO',
        ],
        [
            'size' => 13,
            'start' => 217,
            'type' => Numeric::class,
            'name' => 'TARIFA_BOLETO_VENDEDOR',
        ],
        [
            'size' => 13,
            'start' => 230,
            'type' => Numeric::class,
            'name' => 'TAXA_REP_APLICACAO',
        ],
        [
            'size' => 13,
            'start' => 243,
            'type' => Numeric::class,
            'name' => 'VALOR_LIQUIDO_TRANSACAO',
        ],
        [
            'size' => 13,
            'start' => 256,
            'type' => Numeric::class,
            'name' => 'TAXA_ANTECIPACAO',
        ],
        [
            'size' => 13,
            'start' => 269,
            'type' => Numeric::class,
            'name' => 'VALOR_LIQUIDO_ANTECIPACAO',
        ],
        [
            'size' => 2,
            'start' => 282,
            'type' => Numeric::class,
            'name' => 'STATUS_PAGAMENTO',
        ],
        [
            'size' => 2,
            'start' => 284,
            'type' => AlphaNumeric::class,
            'name' => 'IDENTIFICADOR_REVENDA',
        ],
        [
            'size' => 2,
            'start' => 286,
            'type' => Numeric::class,
            'name' => 'MEIO_PAGAMENTO',
        ],
        [
            'size' => 30,
            'start' => 288,
            'type' => AlphaNumeric::class,
            'name' => 'INSTITUICAO_FINANCEIRA',
        ],
        [
            'size' => 2,
            'start' => 318,
            'type' => AlphaNumeric::class,
            'name' => 'CANAL_ENTRADA',
        ],
        [
            'size' => 2,
            'start' => 320,
            'type' => Numeric::class,
            'name' => 'LEITOR',
        ],
        [
            'size' => 2,
            'start' => 322,
            'type' => Numeric::class,
            'name' => 'MEIO_CAPTURA',
        ],
        [
            'size' => 6,
            'start' => 324,
            'type' => Numeric::class,
            'name' => 'COD_BANCO',
        ],
        [
            'size' => 9,
            'start' => 330,
            'type' => AlphaNumeric::class,
            'name' => 'BANCO_AGENCIA',
        ],
        [
            'size' => 16,
            'start' => 339,
            'type' => AlphaNumeric::class,
            'name' => 'CONTA_BANCO',
        ],
        [
            'size' => 32,
            'start' => 355,
            'type' => AlphaNumeric::class,
            'name' => 'NUM_LOGICO',
        ],
        [
            'size' => 14,
            'start' => 387,
            'type' => AlphaNumeric::class,
            'name' => 'NSU',
        ],
        [
            'size' => 6,
            'start' => 401,
            'type' => AlphaNumeric::class,
            'name' => 'CARTAO_BIN',
        ],
        [
            'size' => 4,
            'start' => 407,
            'type' => AlphaNumeric::class,
            'name' => 'CARTAO_HOLDER',
        ],
        [
            'size' => 6,
            'start' => 411,
            'type' => AlphaNumeric::class,
            'name' => 'CODIGO_AUTORIZACAO',
        ],
        [
            'size' => 32,
            'start' => 417,
            'type' => AlphaNumeric::class,
            'name' => 'CODIGO_CV',
        ],
        [
            'size' => 32,
            'start' => 449,
            'type' => AlphaNumeric::class,
            'name' => 'NUMERO_SERIE_LEITOR',
        ],
        [
            'size' => 50,
            'start' => 481,
            'type' => AlphaNumeric::class,
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
