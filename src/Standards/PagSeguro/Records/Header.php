<?php

namespace Claudsonm\Pedi\Standards\PagSeguro\Records;

use Claudsonm\Pedi\Standards\PagSeguro\Enums\TipoRegistro;
use Claudsonm\Pedi\Standards\PagSeguro\Types\Filler;
use Claudsonm\Pedi\Structure\Field;
use Claudsonm\Pedi\Structure\Record;
use Claudsonm\Pedi\Structure\Types\Any;
use Claudsonm\Pedi\Structure\Types\Numeric;

class Header extends Record
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
            'type' => Any::class,
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
            'type' => Filler::class,
            'name' => 'FILLER',
        ],
        [
            'size' => 3,
            'start' => 71,
            'type' => Any::class,
            'name' => 'VERSAO_LAYOUT',
        ],
        [
            'size' => 3,
            'start' => 74,
            'type' => Any::class,
            'name' => 'VERSAO_RELEASE',
        ],
        [
            'size' => 454,
            'start' => 77,
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
        return TipoRegistro::HEADER === substr($line, 0, 1);
    }

    /**
     * Número do estabelecimento. Identificador único do vendedor no PagSeguro.
     *
     * @return int
     */
    public function getEstabelecimento(): int
    {
        return $this->fields[2]->getContent();
    }
}
