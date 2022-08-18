<?php

namespace Galaktika\Events;

use Galaktika\Data\Fleet;

class FleetTurnEvent
{
    private Fleet $fleet;

    /**
     * @param Fleet $fleet
     */
    public function __construct(Fleet $fleet)
    {
        $this->fleet = $fleet;
    }

    public function getFleet(): Fleet
    {
        return $this->fleet;
    }
}