<?php

namespace Galaktika\Events;

use Galaktika\Data\Fleet;
use Galaktika\Data\GameTurn;

class FleetTurnEvent
{
    private Fleet $fleet;
    private Fleet $newFleet;
    private GameTurn $turn;

    /**
     * @param Fleet $fleet
     * @param Fleet $newFleet
     * @param GameTurn $turn
     */
    public function __construct(Fleet $fleet, Fleet $newFleet, GameTurn $turn)
    {
        $this->fleet = $fleet;
        $this->newFleet = $newFleet;
        $this->turn = $turn;
    }


    public function getFleet(): Fleet
    {
        return $this->fleet;
    }

    public function getNewFleet(): Fleet
    {
        return $this->newFleet;
    }

    public function getTurn(): GameTurn
    {
        return $this->turn;
    }
}