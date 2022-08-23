<?php

namespace Galaktika\Dummy;

use Galaktika\Events\FleetTurnEvent;
use Galaktika\Events\MovementEvent;
use Galaktika\Events\PlanetSurfaceTurnEvent;
use Galaktika\Fleet\Listeners\FleetFlyer;
use Galaktika\Fleet\Listeners\MovementRegisterer;
use Galaktika\PlanetSurface\Listeners\PlanetSurfaceIdAssigner;
use Galaktika\PlanetSurface\Listeners\PlanetSurfaceIndustryGrower;
use Galaktika\PlanetSurface\Listeners\PlanetSurfacePopulationGrower;
use Galaktika\PlanetSurface\Listeners\PlanetSurfaceShipProducer;
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
        $eventDispatcher->registerListener(
            PlanetSurfaceTurnEvent::class,
            [new PlanetSurfaceShipProducer($idGenerator), 'call']
        );
        $eventDispatcher->registerListener(
            FleetTurnEvent::class,
            [new FleetFlyer($eventDispatcher), 'call']
        );
        $eventDispatcher->registerListener(
            MovementEvent::class,
            [new MovementRegisterer(DummyMovementRepository::getInstance()), 'call']
        );

        return $eventDispatcher;
    }
}