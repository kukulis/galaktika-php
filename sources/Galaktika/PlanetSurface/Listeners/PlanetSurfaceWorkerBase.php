<?php

namespace Galaktika\PlanetSurface\Listeners;

use Galaktika\Events\PlanetSurfaceTurnEvent;

class PlanetSurfaceWorkerBase
{
    protected const EPSILON_INDUSTRY = 0.01;

    protected function getProductionPower(PlanetSurfaceTurnEvent $event): float
    {
        $industry = max($event->getPlanetSurface()->getIndustry(), self::EPSILON_INDUSTRY);
        $population = $event->getPlanetSurface()->getPopulation();

        return min($industry, $population) * 2;
    }
}