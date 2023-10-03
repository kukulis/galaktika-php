<?php

namespace Galaktika\V2\Data;

class Location
{
    private float $x;
    private float $y;

    public function getX(): float
    {
        return $this->x;
    }

    public function setX(float $x): Location
    {
        $this->x = $x;

        return $this;
    }

    public function getY(): float
    {
        return $this->y;
    }

    public function setY(float $y): Location
    {
        $this->y = $y;

        return $this;
    }
}