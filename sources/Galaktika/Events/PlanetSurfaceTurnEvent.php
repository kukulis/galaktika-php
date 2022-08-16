<?php

namespace Galaktika\Events;

use Galaktika\Data\PlanetSurface;
use Galaktika\Data\Ship;
use Galaktika\Data\ShipGroup;
use Galaktika\Data\Technologies;

class PlanetSurfaceTurnEvent
{
    const MODE_INDUSTRY = 'industry';
    const MODE_CAPITAL = 'capital';
    const MODE_SHIP = 'ship';

    private PlanetSurface $planetSurface;
    private PlanetSurface $newPlanetSurface;
    private string $productionMode;
    private ?Technologies $technologies;

    private ShipGroup $producedShipGroup;

    public function __construct(
        PlanetSurface $planetSurface,
        PlanetSurface $newPlanetSurface,
        string $productionMode = self::MODE_INDUSTRY,
        ?Technologies $technologies = null
    ) {
        $this->planetSurface = $planetSurface;
        $this->newPlanetSurface = $newPlanetSurface;
        $this->productionMode = $productionMode;
        $this->technologies = $technologies;
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

    public function getTechnologies(): ?Technologies
    {
        return $this->technologies;
    }

    public function getProducedShipGroup(): ShipGroup
    {
        return $this->producedShipGroup;
    }

    public function setProducedShipGroup(ShipGroup $producedShipGroup): PlanetSurfaceTurnEvent
    {
        $this->producedShipGroup = $producedShipGroup;

        return $this;
    }

}