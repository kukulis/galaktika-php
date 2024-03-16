<?php

namespace Galaktika\V2\Battle;

use Galaktika\V2\Data\Fleet;
use Galaktika\V2\Data\PlanetSurface;

class Destruction
{
    private Fleet $fleet;
    private PlanetSurface $planetSurface;

    /**
     * @param Fleet $fleet
     * @param PlanetSurface $planetSurface
     */
    public function __construct(Fleet $fleet, PlanetSurface $planetSurface)
    {
        $this->fleet = $fleet;
        $this->planetSurface = $planetSurface;
    }

    public function getFleet(): Fleet
    {
        return $this->fleet;
    }

    public function getPlanetSurface(): PlanetSurface
    {
        return $this->planetSurface;
    }
}