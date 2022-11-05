<?php

namespace Galaktika\Data;

use Galaktika\Util\HasKey;

class Subject implements HasKey
{
    private string $id;

    private string $name;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getKey(): string
    {
        return $this->id;
    }

    public function setKey(string $key)
    {
        $this->setId($key);
    }
}