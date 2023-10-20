<?php

namespace Galaktika\V2\Data;

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


    public static function buildKey(float $x, float $y): string
    {
        return sprintf('%.05f:%.05f', $x, $y);
    }

    public function getKey(): string
    {
        return self::buildKey($this->x, $this->y);
    }
}