<?php

namespace Galaktika\Dummy;

use Galaktika\Events\PlanetSurfaceTurnEvent;
use Galaktika\PlanetSurface\Listeners\PlanetSurfaceIdAssigner;
use Galaktika\PlanetSurface\Listeners\PlanetSurfaceIndustryGrower;
use Galaktika\PlanetSurface\Listeners\PlanetSurfacePopulationGrower;
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
        $eventDispatcher->registerListener(
            PlanetSurfaceTurnEvent::class,
            [new PlanetSurfacePopulationGrower(), 'call']
        );
        $eventDispatcher->registerListener(
            PlanetSurfaceTurnEvent::class,
            [new PlanetSurfaceIndustryGrower(), 'call']
        );

        return $eventDispatcher;
    }
}