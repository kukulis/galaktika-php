<?php

namespace Galaktika\Events;

use Galaktika\Data\PlanetSurface;

class PlanetSurfaceTurnEvent
{
    private PlanetSurface $planetSurface;
    private PlanetSurface $newPlanetSurface;

    public function __construct(
        PlanetSurface $planetSurface,
        PlanetSurface $newPlanetSurface
    ) {
        $this->planetSurface = $planetSurface;
        $this->newPlanetSurface = $newPlanetSurface;
    }

    public function getPlanetSurface(): PlanetSurface
    {
        return $this->planetSurface;
    }

    public function getNewPlanetSurface(): PlanetSurface
    {
        return $this->newPlanetSurface;
    }

}