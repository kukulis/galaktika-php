<?php

namespace Galaktika\Data\Registry;

use Galaktika\Data\Fleet;
use Galaktika\Data\GameTurn;
use Galaktika\Data\Location;

class FleetRegistry
{
    private GameTurn $gameTurn;
    private Fleet $fleet;
    private Location $location;

    public function getGameTurn(): GameTurn
    {
        return $this->gameTurn;
    }

    public function setGameTurn(GameTurn $gameTurn): void
    {
        $this->gameTurn = $gameTurn;
    }

    public function getFleet(): Fleet
    {
        return $this->fleet;
    }

    public function setFleet(Fleet $fleet): void
    {
        $this->fleet = $fleet;
    }

    public function getLocation(): Location
    {
        return $this->location;
    }

    public function setLocation(Location $location): FleetRegistry
    {
        $this->location = $location;

        return $this;
    }
}