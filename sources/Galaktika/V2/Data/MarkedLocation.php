<?php

namespace Galaktika\V2\Data;

class MarkedLocation implements ILocation
{
    use DistanceTrait;

    private float $x;
    private float $y;

    private bool $enabled = true;

    /**
     * @param float $x
     * @param float $y
     */
    public function __construct(float $x, float $y)
    {
        $this->x = $x;
        $this->y = $y;
    }

    /**
     * @return float
     */
    public function getX(): float
    {
        return $this->x;
    }

    /**
     * @return float
     */
    public function getY(): float
    {
        return $this->y;
    }

    /**
     * @return bool
     */
    public function isEnabled(): bool
    {
        return $this->enabled;
    }

    /**
     * @param bool $enabled
     */
    public function setEnabled(bool $enabled): void
    {
        $this->enabled = $enabled;
    }

    public function getLocation(): Location
    {
        return (new Location())->setX($this->x)->setY($this->y);
    }

    public function setX(float $x): ILocation
    {
        $this->x = $x;

        return $this;
    }

    public function setY(float $y): ILocation
    {
        $this->y = $y;

        return $this;
    }
}