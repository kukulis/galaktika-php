<?php

namespace Galaktika\Data\Registry;

use Galaktika\Data\Fleet;
use Galaktika\Data\GameTurn;

class FleetRegistry
{
    private GameTurn $gameTurn;
    private Fleet $fleet;

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
}