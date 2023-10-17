<?php

namespace Galaktika\V2\Data;

use Galaktika\Util\Math;

class Location implements ILocation
{
    use DistanceTrait;

    private float $x;
    private float $y;

    public function getX(): float
    {
        return $this->x;
    }

    public function setX(float $x): self
    {
        $this->x = $x;

        return $this;
    }

    public function getY(): float
    {
        return $this->y;
    }

    public function setY(float $y): self
    {
        $this->y = $y;

        return $this;
    }

}