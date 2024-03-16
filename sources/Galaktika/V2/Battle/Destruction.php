<?php

namespace Galaktika\V2\Battle;

use Galaktika\V2\Data\Fleet;
use Galaktika\V2\Data\PlanetSurface;
use Galaktika\V2\Data\Ship;

class Destruction
{
    /**
     * @var Ship[]
     */
    private array $ships;
    private PlanetSurface $planetSurface;


    public function getPlanetSurface(): PlanetSurface
    {
        return $this->planetSurface;
    }

    public function setPlanetSurface(PlanetSurface $planetSurface): Destruction
    {
        $this->planetSurface = $planetSurface;
        return $this;
    }

    public function getShips(): array
    {
        return $this->ships;
    }

    public function setShips(array $ships): Destruction
    {
        $this->ships = $ships;
        return $this;
    }
}