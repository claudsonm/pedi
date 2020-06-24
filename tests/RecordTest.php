<?php

namespace Claudsonm\Pedi\Tests;

use Claudsonm\Pedi\Layouts\PagSeguro\Enums\TipoEvento;
use Claudsonm\Pedi\Layouts\PagSeguro\Enums\TipoExtrato;
use Claudsonm\Pedi\Layouts\PagSeguro\Enums\TipoRegistro;
use Claudsonm\Pedi\Structure\Types\AlphaNumeric;
use Claudsonm\Pedi\Structure\Types\Numeric;

class RecordTest extends TestCase
{
    /** @test */
    public function it_can_parse_a_header_record_and_output_as_string()
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
        $header = $this->makeRecord($definitions);

        $line = implode('', [
            TipoRegistro::HEADER, // TIPO_REGISTRO
            '9999999999', // ESTABELECIMENTO
            '20200614', // DATA_PROCESSAMENTO
            '20200601', // DATA_INICIO
            '20200612', // DATA_FIM
            '7777777', // SEQUENCIA_ARQUIVO
            'PAGSG', // ADQUIRENTE
            TipoExtrato::FINANCEIRO, // TIPO_EXTRATO
            'AAAAAAAAAAAAAAAAAAAAA', // FILLER
            '002', // VERSAO_LAYOUT
            '.01', // VERSAO_RELEASE
            str_repeat('G', 454), // INTERNO
        ]);
        $header->parse($line);

        $this->assertSame($line, $header->getLineContent());
    }

    /** @test */
    public function it_can_parse_a_trailer_record_and_output_as_string()
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
        $trailer = $this->makeRecord($definitions);

        $line = implode('', [
            TipoRegistro::TRAILER, // TIPO_REGISTRO
            '00000000005', // QUANTIDADE_REGISTROS
            str_repeat('G', 518), // INTERNO
        ]);
        $trailer->parse($line);

        $this->assertSame($line, $trailer->getLineContent());
    }

    /** @test */
    public function it_can_parse_a_saldo_record_and_output_as_string()
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
        $saldo = $this->makeRecord($definitions);

        $line = implode('', [
            TipoRegistro::SALDO, // TIPO_REGISTRO
            '9999999999', // QUANTIDADE_REGISTROS
            '20200611', // DATA_MOVIMENTACAO
            TipoEvento::VENDA_OU_PAGAMENTO, // TIPO_EVENTO
            '0000000265425', // VALOR_SALDO
        ]);
        $saldo->parse($line);

        $this->assertSame($line, $saldo->getLineContent());
    }
}
