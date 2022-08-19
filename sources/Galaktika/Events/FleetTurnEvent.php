<?php

namespace Galaktika\Events;

use Galaktika\Data\Fleet;

class FleetTurnEvent
{
    private Fleet $fleet;
    private Fleet $newFleet;

    /**
     * @param Fleet $fleet
     * @param Fleet $newFleet
     */
    public function __construct(Fleet $fleet, Fleet $newFleet)
    {
        $this->fleet = $fleet;
        $this->newFleet = $newFleet;
    }

    public function getFleet(): Fleet
    {
        return $this->fleet;
    }

    public function getNewFleet(): Fleet
    {
        return $this->newFleet;
    }
}