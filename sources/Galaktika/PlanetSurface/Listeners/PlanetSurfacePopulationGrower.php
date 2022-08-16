<?php

namespace Galaktika\PlanetSurface\Listeners;

use Galaktika\Data\PlanetSurface;
use Galaktika\Events\PlanetSurfaceTurnEvent;

class PlanetSurfacePopulationGrower
{
    const POPULATION_GROW_COEFFICIENT = 1.2;
    const POPULATION_OVERGROW_COEFFICIENT = 1.3;
    public function call(PlanetSurfaceTurnEvent $event) {
        $newPopulation = $event->getPlanetSurface()->getPopulation() * self::POPULATION_GROW_COEFFICIENT;
        $maxPopulation = $event->getPlanetSurface()->getPlanet()->getSize()  * self::POPULATION_OVERGROW_COEFFICIENT;
        $event->getNewPlanetSurface()->setPopulation( min($maxPopulation, $newPopulation) );
    }
}