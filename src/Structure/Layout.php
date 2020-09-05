<?php

namespace Claudsonm\Pedi\Structure;

use Claudsonm\Pedi\Exceptions\PediException;
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

    private SplTempFileObject $file;

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

        $occurrences = '*' === $occurrences ? $occurrences : (int) $occurrences;
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
        $this->file = $this->makeFileObject($fileContent);
        $currentSection = 0;
        while ($this->file->valid()) {
            /** @var Record $baseRecord */
            [$baseRecord, $times] = $this->structure[$currentSection];

            do {
                $line = $this->file->getCurrentLine();
                $endOfCurrentLine = $this->file->ftell();

                /** @var Record $item */
                $item = unserialize(serialize($baseRecord));
                $item->setLineNumber($this->file->key() + 1);
                $item->parse($line);
                $this->contents[] = $item;

                if ('*' === $times) {
                    try {
                        $nextLine = $this->file->getCurrentLine();
                    } catch (\RuntimeException $exception) {
                        break;
                    }
                    $this->file->fseek($endOfCurrentLine);
                    $moreRecordsExists = $baseRecord->matches($nextLine);
                } else {
                    $times--;
                    $moreRecordsExists = $times > 0;
                }
            } while ($moreRecordsExists);

            $currentSection++;
        }
    }

    private function makeFileObject(string $fileContent): SplTempFileObject
    {
        $file = new SplTempFileObject();
        $file->setFlags(SplTempFileObject::DROP_NEW_LINE);
        $file->fwrite($fileContent);
        $file->rewind();

        return $file;
    }
}
