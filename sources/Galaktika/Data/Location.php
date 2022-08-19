<?php

namespace Galaktika\Data;

class Location
{
    public const EPSILON = 0.000001;

    private int $id;
    private ?Planet $planet;
    private float $x;
    private float $y;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getPlanet(): ?Planet
    {
        return $this->planet;
    }

    public function setPlanet(?Planet $planet): void
    {
        $this->planet = $planet;
    }

    public function getX(): float
    {
        return $this->x;
    }

    public function setX(float $x): void
    {
        $this->x = $x;
    }

    public function getY(): float
    {
        return $this->y;
    }

    public function setY(float $y): void
    {
        $this->y = $y;
    }

    public function equals(Location $l): bool
    {
        return
            abs($l->getX() - $this->getX()) < self::EPSILON &&
            abs($l->getY() - $this->getY()) < self::EPSILON;
    }


    public function vector(Location $destination): Vector
    {
        $x = $destination->getX() - $this->getX();
        $y = $destination->getY() - $this->getY();

        return new Vector($x, $y);
    }


}