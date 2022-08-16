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

    public function setId(string $id): Planet
    {
        $this->id = $id;

        return $this;
    }

    public function getSize(): float
    {
        return $this->size;
    }

    public function setSize(float $size): Planet
    {
        $this->size = $size;

        return $this;
    }

    public function getRichness(): float
    {
        return $this->richness;
    }

    public function setRichness(float $richness): Planet
    {
        $this->richness = $richness;

        return $this;
    }
}