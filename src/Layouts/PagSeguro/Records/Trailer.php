<?php

namespace Claudsonm\Pedi\Layouts\PagSeguro\Records;

use Claudsonm\Pedi\Layouts\PagSeguro\Enums\TipoRegistro;
use Claudsonm\Pedi\Structure\Field;
use Claudsonm\Pedi\Structure\Record;
use Claudsonm\Pedi\Structure\Types\Any;
use Claudsonm\Pedi\Structure\Types\Numeric;

class Trailer extends Record
{
    private array $definitions = [
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

    public function matches(string $line): bool
    {
        return TipoRegistro::TRAILER === substr($line, 0, 1);
    }
}
