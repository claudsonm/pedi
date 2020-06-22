<?php

namespace Claudsonm\Pedi\Structure;

use Claudsonm\Pedi\PediException;

class Layout
{
    /**
     * @var array|Record[]
     */
    protected array $contents = [];

    /**
     * Defines the records and their occurrences within the layout.
     */
    protected array $structure = [];

    /**
     * Adds a record definition to the end of the layout structure.
     *
     * @param int|string $occurrences the amount of sequential items expected for the given record
     *
     * @throws PediException
     *
     * @return $this
     */
    public function append(Record $record, $occurrences = 1): self
    {
        if (! preg_match('/^([1-9][0-9]*)|(\*)$/', $occurrences)) {
            throw PediException::invalidQuantifier();
        }

        $occurrences = '*' === $occurrences ? -1 : (int) $occurrences;
        $this->structure[] = [$record, $occurrences];

        return $this;
    }

    /**
     * @return array|Record[]
     */
    public function getContents(): array
    {
        return $this->contents;
    }

    public function getTotalOfRecords(): int
    {
        return count($this->contents);
    }

    public function getSummary()
    {
        $summary = [];
        foreach ($this->structure as $section) {
        }

        return $summary;
    }

    public function getStructure(): array
    {
        return $this->structure;
    }
}
