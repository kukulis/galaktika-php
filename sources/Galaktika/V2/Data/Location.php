<?php

namespace Galaktika\V2\Data;

use Galaktika\Util\Math;

class Location implements ILocation
{
    use DistanceTrait;

    private float $x = 0;
    private float $y = 0;

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

    public function getDeltaX(Location $destination): float
    {
        return $destination->getX() - $this->x;
    }

    public function getDeltaY(Location $destination): float
    {
        return $destination->getY() - $this->y;
    }

    public function getDistance(Location $destination): float
    {
        return Math::getDistance($this->getX(), $this->getY(), $destination->getX(), $destination->getY());
    }
}