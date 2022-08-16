<?php

namespace Galaktika\PlanetSurface\Listeners;

use Galaktika\Events\PlanetSurfaceTurnEvent;
use Galaktika\IdGenerator;

class PlanetSurfaceIdAssigner
{
    private IdGenerator $idGenerator;
    public function __construct(
        IdGenerator $idGenerator
    ) {
        $this->idGenerator = $idGenerator;
    }

    public function call(PlanetSurfaceTurnEvent $event)
    {
        $event->getNewPlanetSurface()->setId($this->idGenerator->generateId());
    }
}