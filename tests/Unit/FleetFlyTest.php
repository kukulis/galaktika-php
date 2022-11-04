<?php

namespace Tests\Unit;

use Galaktika\Action\FleetTurnMaker;
use Galaktika\Data\Fleet;
use Galaktika\Data\GameTurn;
use Galaktika\Data\Location;
use Galaktika\Data\Ship;
use Galaktika\Data\ShipGroup;
use Galaktika\Dummy\DummyEventDispatcherFactory;
use Galaktika\Dummy\DummyMovementRepository;
use Galaktika\Repositories\MovementFilter;
use PHPUnit\Framework\TestCase;

class FleetFlyTest extends TestCase
{
    public function testFlyPartWay() {
        $fleet = new Fleet();
        $fleet->addGroup(ShipGroup::build(Ship::build(1, 1,1,1,1, 1), 1));
        $initialLocation = Location::build(0,0);
        $fleet->setCurrentLocation($initialLocation);
        $destinationLocation = Location::build(200, 0);
        $fleet->setDestinationLocation($destinationLocation);
        $fleet->setId('testFleet');

        $dummyEventDispatcherFactory = new DummyEventDispatcherFactory();
        $eventDispatcher = $dummyEventDispatcherFactory->configureEventDispatcher();


        $gameTurn = new GameTurn();
        $fleetTurnMaker = new FleetTurnMaker($eventDispatcher);
        $fleetTurnMaker->makeFleetTurn($fleet, $gameTurn);


        $movementRepository = DummyMovementRepository::getInstance();

        $movementsMap = $movementRepository->getMovements(new MovementFilter());
        $movements = array_values ($movementsMap);

        $this->assertCount(1, $movements);


        $movements[0]->getLocation()->equals($initialLocation);
        $movements[0]->getNewLocation()->equals($fleet->getCurrentLocation());
        $this->assertTrue( $movements[0]->getNewLocation()->getX() > $movements[0]->getLocation()->getX());
    }

    public function _testFlyFullWay() {
        // TODO
    }

    public function _testStayInPlace() {
        // TODO
    }
}