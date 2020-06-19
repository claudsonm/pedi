<?php

namespace Claudsonm\Pedi\Structure;

class Layout
{
    /**
     * @var array|Record[]
     */
    protected array $records;

    public function add(Record $record): self
    {
        $this->records[] = $record;

        return $this;
    }

    /**
     * @return array|Record[]
     */
    public function getRecords(): array
    {
        return $this->records;
    }

    public function getTotalOfRecords(): int
    {
        return count($this->records);
    }

    public function parse(string $content)
    {

    }

}
