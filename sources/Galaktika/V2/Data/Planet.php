<?php

namespace Galaktika\V2\Data;

class Planet
{
    private string $id;

    private Location $location;
    private float $size = 100;

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): Planet
    {
        $this->id = $id;

        return $this;
    }

    public function getLocation(): Location
    {
        return $this->location;
    }

    public function setLocation(Location $location): Planet
    {
        $this->location = $location;

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

}