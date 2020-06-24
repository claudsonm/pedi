<?php

namespace Claudsonm\Pedi\Structure;

use Claudsonm\Pedi\Structure\Types\AlphaNumeric;
use Claudsonm\Pedi\Structure\Types\Type;

class Field
{
    /**
     * Indicates the number of characters/positions the information uses.
     */
    protected int $size;

    /**
     * Identifies the information starting position in the file.
     */
    protected int $start;

    /**
     * Indicates the type of information the field holds.
     */
    protected Type $type;

    /**
     * Identifies field name.
     */
    protected string $name = '';

    /**
     * Further explanation about the information in the field.
     */
    protected string $description = '';

    /**
     * The field contents.
     */
    protected $content;

    public function getSize(): int
    {
        return $this->size;
    }

    public function setSize(int $size): self
    {
        $this->size = $size;

        return $this;
    }

    public function getStart(): int
    {
        return $this->start;
    }

    public function setStart(int $start): self
    {
        $this->start = $start;

        return $this;
    }

    public function getType(): Type
    {
        return $this->type ?? new AlphaNumeric();
    }

    public function setType(Type $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getContent()
    {
        return $this->getType()->castToString($this, $this->content);
    }

    public function setContent(string $content): self
    {
        $this->content = $this->getType()->castFromLine($this, $content);

        return $this;
    }
}
