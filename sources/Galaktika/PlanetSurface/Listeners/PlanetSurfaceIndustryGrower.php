<?php

namespace Galaktika\PlanetSurface\Listeners;

use Galaktika\Events\PlanetSurfaceTurnEvent;

class PlanetSurfaceIndustryGrower
{
    const EPSILON_INDUSTRY = 0.01;

    public function call(PlanetSurfaceTurnEvent $event)
    {

        $industry = max($event->getPlanetSurface()->getIndustry(), self::EPSILON_INDUSTRY);
        $population = $event->getPlanetSurface()->getPopulation();
        $productionPower = min($industry, $population) * 2;

        $size = $event->getPlanetSurface()->getPlanet()->getSize();


        if ($event->getProductionMode() == PlanetSurfaceTurnEvent::MODE_INDUSTRY) {
            $additionalCapital = 0;
            if ($productionPower + $industry > $size) {
                $additionalCapital = $productionPower + $industry - $size;
            }

            $event->getNewPlanetSurface()->setIndustry(min($size, $productionPower + $industry));
            $event->getNewPlanetSurface()->setCapital($event->getPlanetSurface()->getCapital() + $additionalCapital);
        }

        if ( $event->getProductionMode() == PlanetSurfaceTurnEvent::MODE_CAPITAL) {
            $event->getNewPlanetSurface()->setCapital($event->getPlanetSurface()->getCapital() + $productionPower);
        }

        // the case when mode is a "ship production" is handled by other listener
    }
}