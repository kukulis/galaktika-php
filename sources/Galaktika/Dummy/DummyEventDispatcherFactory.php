<?php

namespace Galaktika\Dummy;

use Galaktika\Events\PlanetSurfaceTurnEvent;
use Galaktika\PlanetSurface\Listeners\PlanetSurfaceIdAssigner;
use Galaktika\SimpleIdGenerator;

class DummyEventDispatcherFactory
{
    public function configureEventDispatcher(): DummyEventDispatcher
    {
        $eventDispatcher = new DummyEventDispatcher();

        $idGenerator = new SimpleIdGenerator();
        $eventDispatcher->registerListener(
            PlanetSurfaceTurnEvent::class,
            [new PlanetSurfaceIdAssigner($idGenerator), 'call']
        );

        return $eventDispatcher;
    }
}