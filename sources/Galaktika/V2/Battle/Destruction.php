<?php

namespace Galaktika\V2\Battle;

use Galaktika\V2\Data\Fleet;
use Galaktika\V2\Data\PlanetSurface;

class Destruction
{
    private Fleet $fleet;
    private PlanetSurface $planetSurface;

    public function getFleet(): Fleet
    {
        return $this->fleet;
    }

    public function getPlanetSurface(): PlanetSurface
    {
        return $this->planetSurface;
    }

    public function setFleet(Fleet $fleet): Destruction
    {
        $this->fleet = $fleet;
        return $this;
    }

    public function setPlanetSurface(PlanetSurface $planetSurface): Destruction
    {
        $this->planetSurface = $planetSurface;
        return $this;
    }
}