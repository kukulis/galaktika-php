<?php

namespace Tests\Unit;

use Galaktika\Action\PlanetSurfaceTurnMaker;
use Galaktika\Data\Planet;
use Galaktika\Data\PlanetSurface;
use Galaktika\Data\ShipProject;
use Galaktika\Data\Technologies;
use Galaktika\Dummy\DummyEventDispatcherFactory;
use Galaktika\Events\PlanetSurfaceTurnEvent;
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
        $planetSurface->setPlanet((new Planet())->setSize(100));
        $newPlanetSurface = $planetSurfaceTurnMaker->makePlanetSurfaceTurn(
            $planetSurface,
            new Technologies(),
            PlanetSurfaceTurnEvent::MODE_INDUSTRY
        )->getNewPlanetSurface();

        $this->assertNotEquals($planetSurface->getId(), $newPlanetSurface->getId());

        $this->assertTrue(true);
    }

    public function testBuildShips()
    {
        $shipProject = new ShipProject();
        $shipProject->setGuns(1);
        $shipProject->setGunMass(1);
        $shipProject->setCargoMass(1);
        $shipProject->setEngineMass(1);
        $shipProject->setShieldMass(1);
        $shipProject->setName('pirmas');
        $this->assertEquals(4, $shipProject->getWeight());

        $planetSurface = new PlanetSurface();
        $planet = new Planet();
        $planet->setSize(1000);
        $planet->setId('aaa');
        $planetSurface->setPlanet($planet);
        $planetSurface->setShipProject($shipProject);

        $planetSurface->setPopulation(1000);
        $planetSurface->setIndustry(1000);
        $planetSurface->setCapital(0);

        $dummyEventDispatcherFactory = new DummyEventDispatcherFactory();
        $dummyEventDispatcherFactory->configureEventDispatcher();
        $planetSurfaceTurnMaker = new PlanetSurfaceTurnMaker($dummyEventDispatcherFactory->configureEventDispatcher());

        $event = $planetSurfaceTurnMaker->makePlanetSurfaceTurn(
            $planetSurface,
            new Technologies(),
            PlanetSurfaceTurnEvent::MODE_SHIP
        );
        $this->assertEquals(250, $event->getProducedShipGroup()->getAmount());
        $this->assertEquals(4, $event->getProducedShipGroup()->getShip()->getWeight());
        $this->assertEquals(1, $event->getProducedShipGroup()->getShip()->getGuns());
        $this->assertEquals(1, $event->getProducedShipGroup()->getShip()->getAttack());
        $this->assertEquals(1, $event->getProducedShipGroup()->getShip()->getDefence());
        $this->assertEquals(1, $event->getProducedShipGroup()->getShip()->getCargo());
        $this->assertEquals(1, $event->getProducedShipGroup()->getShip()->getEngine());
    }
}