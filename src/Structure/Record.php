<?php

namespace Claudsonm\Pedi\Structure;

class Record
{
    protected string $name;

    /**
     * @var array|Field[]
     */
    protected array $fields;

    /**
     * @return Record
     */
    public function add(Field $field)
    {
        $this->fields[] = $field;

        return $this;
    }

    public function mount(): string
    {
        $line = '';
        foreach ($this->fields as $field) {
            $line .= $field->getContent();
        }

        return $line;
    }

    public function parse(string $line): void
    {
        foreach ($this->fields as $field) {
            $value = substr($line, $field->getStart() - 1, $field->getSize());
            $field->setContent($value);
        }
    }
}
