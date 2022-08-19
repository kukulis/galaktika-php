<?php

namespace Galaktika\Data;

class Vector
{
    private float $x;
    private float $y;

    public function __construct(float $x, float $y)
    {
        $this->x = $x;
        $this->y = $y;
    }

    public function getX(): float
    {
        return $this->x;
    }

    public function getY(): float
    {
        return $this->y;
    }

    public function length(): float
    {
        return sqrt(pow($this->x, 2) + pow($this->y, 2));
    }

    public function one(): Vector
    {
        $length = $this->length();

        return new Vector($this->x / $length, $this->y / $length);
    }

    public function withLength(float $newLength): Vector
    {
        $length = $this->length();

        return new Vector($this->x / $length * $newLength, $this->y / $length * $newLength);
    }

    public function newLocation(Location $oldLocation): Location
    {
        $location = new Location();
        $location->setX($oldLocation->getX() + $this->x);
        $location->setY($oldLocation->getY() + $this->y);

        return $location;
    }

}