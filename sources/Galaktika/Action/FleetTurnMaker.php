<?php

namespace Galaktika\Action;

use Galaktika\Data\Fleet;
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

    public function makeFleetTurn(Fleet $fleet): FleetTurnEvent
    {
        $event = new FleetTurnEvent($fleet);
        $this->eventDispatcher->dispatch($event);

        return $event;
    }
}