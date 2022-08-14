<?php

namespace Galaktika\Data;

class Planet
{
    private string $id;

    private float $size;
    private float $richness;

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    public function getSize(): float
    {
        return $this->size;
    }

    public function setSize(float $size): void
    {
        $this->size = $size;
    }

    public function getRichness(): float
    {
        return $this->richness;
    }

    public function setRichness(float $richness): void
    {
        $this->richness = $richness;
    }
}