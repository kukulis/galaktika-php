<?php

namespace Tests\Unit;

use Galaktika\Action\FleetTurnMaker;
use Galaktika\Dummy\DummyEventDispatcherFactory;
use Galaktika\Fleet\Listeners\FleetFlyer;
use PHPUnit\Framework\TestCase;

class MovementsRepositoryTest extends TestCase
{
    public function testRegisterMovements() {
        $dummyEventDispatcherFactory = new DummyEventDispatcherFactory();
        $eventDispatcher = $dummyEventDispatcherFactory->configureEventDispatcher();
    // TODO
    }

}