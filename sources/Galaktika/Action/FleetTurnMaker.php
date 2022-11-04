<?php

namespace Galaktika\Action;

use Galaktika\Data\Fleet;
use Galaktika\Data\GameTurn;
use Galaktika\Events\FleetTurnEvent;
use Psr\EventDispatcher\EventDispatcherInterface;

class FleetTurnMaker
{
    private EventDispatcherInterface $eventDispatcher;

    public function __construct(
        EventDispatcherInterface $eventDispatcher
    ) {
        $this->eventDispatcher = $eventDispatcher;
    }

    public function makeFleetTurn(Fleet $fleet, GameTurn $gameTurn): FleetTurnEvent
    {
        $newFleet = clone $fleet;
        $event = new FleetTurnEvent($fleet, $newFleet, $gameTurn);
        $this->eventDispatcher->dispatch($event);

        return $event;
    }
}