<?php

namespace Galaktika\Events;

use Galaktika\Data\PlanetSurface;

class PlanetSurfaceTurnEvent
{
    const MODE_INDUSTRY = 'industry';
    const MODE_CAPITAL = 'capital';
    const MODE_SHIP = 'ship';

    private PlanetSurface $planetSurface;
    private PlanetSurface $newPlanetSurface;

    private string $productionMode;

    public function __construct(
        PlanetSurface $planetSurface,
        PlanetSurface $newPlanetSurface,
        string $productionMode = self::MODE_INDUSTRY
    ) {
        $this->planetSurface = $planetSurface;
        $this->newPlanetSurface = $newPlanetSurface;
        $this->productionMode = $productionMode;
    }

    public function getPlanetSurface(): PlanetSurface
    {
        return $this->planetSurface;
    }

    public function getNewPlanetSurface(): PlanetSurface
    {
        return $this->newPlanetSurface;
    }

    public function getProductionMode(): string
    {
        return $this->productionMode;
    }
}