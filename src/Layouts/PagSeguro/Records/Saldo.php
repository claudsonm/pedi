<?php

namespace Claudsonm\Pedi\Layouts\PagSeguro\Records;

use Claudsonm\Pedi\Layouts\PagSeguro\Enums\TipoRegistro;
use Claudsonm\Pedi\Structure\Field;
use Claudsonm\Pedi\Structure\Record;
use Claudsonm\Pedi\Structure\Types\Numeric;

class Saldo extends Record
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

    public function matches(string $line): bool
    {
        return TipoRegistro::SALDO === substr($line, 0, 1);
    }
}
