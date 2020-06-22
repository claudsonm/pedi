<?php

namespace Claudsonm\Pedi\Structure;

use Claudsonm\Pedi\PediException;
use SplTempFileObject;

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

    public function getStructure(): array
    {
        return $this->structure;
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

    public function parse(string $fileContent)
    {
        $file = $this->makeTemporaryFileObject($fileContent);
        $currentSection = 0;
        while ($file->valid()) {
            $line = $file->getCurrentLine();
            $endOfCurrentLine = $file->ftell();

            [$baseRecord, $times] = $this->structure[$currentSection];
            $novo = unserialize(serialize($baseRecord));
            var_dump($baseRecord, $novo);
            // $ob->

            $this->contents[] = $this->structure[$currentSection];
            // -----------
            try {
                $nextLine = $file->getCurrentLine();
            } catch (\RuntimeException $exception) {
                break;
            }
            // var_dump('NEXT', $nextLine);
            // -----------
            $currentSection++;
            $file->fseek($endOfCurrentLine);
        }
    }

    private function makeTemporaryFileObject(string $fileContent): SplTempFileObject
    {
        $file = new SplTempFileObject();
        $file->setFlags(SplTempFileObject::DROP_NEW_LINE);
        $file->fwrite($fileContent);
        $file->rewind();

        return $file;
    }
}
