<?php

namespace Tests\Unit;

use Galaktika\Action\PlanetSurfaceTurnMaker;
use Galaktika\Data\PlanetSurface;
use Galaktika\Dummy\DummyEventDispatcherFactory;
use PHPUnit\Framework\TestCase;

class PlanetGrowTest extends TestCase
{
    public function testPlanetGrow()
    {
        $dummyEventDispatcherFactory = new DummyEventDispatcherFactory();
        $dummyEventDispatcherFactory->configureEventDispatcher();
        $planetSurfaceTurnMaker = new PlanetSurfaceTurnMaker($dummyEventDispatcherFactory->configureEventDispatcher());


        $planetSurface = new PlanetSurface();
        $planetSurface->setId('aaa');
        $newPlanetSurface = $planetSurfaceTurnMaker->makePlanetSurfaceTurn($planetSurface);

        $this->assertNotEquals($planetSurface->getId(), $newPlanetSurface->getId());

        $this->assertTrue(true);
    }

}