<?php

namespace Galaktika\V2\Battle;

use Galaktika\V2\Data\Ship;

class Conflict
{
    /**
     * @var Ship[][]
     */
    private array $sides=[[],[]];

    private float $x;
    private float $y;

    /**
     * @return float
     */
    public function getX(): float
    {
        return $this->x;
    }

    /**
     * @param float $x
     */
    public function setX(float $x): void
    {
        $this->x = $x;
    }

    /**
     * @return float
     */
    public function getY(): float
    {
        return $this->y;
    }

    /**
     * @param float $y
     */
    public function setY(float $y): void
    {
        $this->y = $y;
    }

    /**
     * @return Ship[]
     */
    public function getSideShips(int $side) : array {
        return $this->sides[$side];
    }

    public function addShip(int $side, Ship $ship) : self {
        $this->sides[$side][]=$ship;

        return $this;
    }

}