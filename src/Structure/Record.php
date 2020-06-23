<?php

namespace Claudsonm\Pedi\Structure;

class Record
{
    protected string $name;

    /**
     * @var array|Field[]
     */
    protected array $fields;

    protected int $length = 0;

    /**
     * @return Record
     */
    public function add(Field $field)
    {
        $this->fields[] = $field;
        $this->length += $field->getSize();

        return $this;
    }

    public function getLine(): string
    {
        $line = '';
        foreach ($this->fields as $field) {
            $line .= $field->getContent();
        }

        return $line;
    }

    public function getLength(): int
    {
        return $this->length;
    }

    public function parse(string $line): void
    {
        foreach ($this->fields as $field) {
            $value = substr($line, $field->getStart() - 1, $field->getSize());
            $field->setContent($value);
        }
    }

    public function matches(string $line): bool
    {
        return $this->getLength() === strlen($line);
    }
}
