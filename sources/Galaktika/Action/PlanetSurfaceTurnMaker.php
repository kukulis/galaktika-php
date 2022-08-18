<?php

namespace Galaktika\Action;

use Galaktika\Data\PlanetSurface;
use Galaktika\Data\Technologies;
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

    public function makePlanetSurfaceTurn(
        PlanetSurface $planetSurface,
        Technologies $technologies,
        string $productionMode
    ): PlanetSurfaceTurnEvent {
        $newPlanetSurface = clone $planetSurface;
        $event = new PlanetSurfaceTurnEvent($planetSurface, $newPlanetSurface, $productionMode, $technologies);
        $this->eventDispatcher->dispatch($event);

        return $event;
    }
}