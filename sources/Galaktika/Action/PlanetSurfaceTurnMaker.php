<?php

namespace Galaktika\Action;

use Galaktika\Data\PlanetSurface;
use Galaktika\Events\PlanetSurfaceTurnEvent;
use Psr\EventDispatcher\EventDispatcherInterface;

class PlanetSurfaceTurnMaker
{
    private EventDispatcherInterface $eventDispatcher;

    public function __construct(
        EventDispatcherInterface $eventDispatcher
    ) {
        $this->eventDispatcher = $eventDispatcher;
    }

    public function makePlanetSurfaceTurn(PlanetSurface $planetSurface): PlanetSurface
    {
        $newPlanteSurface = clone $planetSurface;
        $event = new PlanetSurfaceTurnEvent($planetSurface, $newPlanteSurface);
        $this->eventDispatcher->dispatch($event);

        return $event->getNewPlanetSurface();
    }
}