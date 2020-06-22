<?php

namespace Claudsonm\Pedi\Support;

use Claudsonm\Pedi\Structure\Field;
use Claudsonm\Pedi\Structure\Record;

trait LayoutHelpers
{
    public function makeRecord(array $fieldsDefinitions = []): Record
    {
        $record = new Record();
        foreach ($fieldsDefinitions as $definition) {
            $field = (new Field())
                ->setSize($definition['size'])
                ->setStart($definition['start'])
                ->setType(new $definition['type']())
                ->setName($definition['name'] ?? '');
            $record->add($field);
        }

        return $record;
    }
}
