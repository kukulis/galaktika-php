<?php

namespace Galaktika\Data\Registry;

use Galaktika\Data\Battle;
use Galaktika\Data\GameTurn;

class BattleRegistry
{
    private Battle $battle;
    private GameTurn $gameTurn;

    public function getBattle(): Battle
    {
        return $this->battle;
    }

    public function setBattle(Battle $battle): BattleRegistry
    {
        $this->battle = $battle;

        return $this;
    }

    public function getGameTurn(): GameTurn
    {
        return $this->gameTurn;
    }

    public function setGameTurn(GameTurn $gameTurn): BattleRegistry
    {
        $this->gameTurn = $gameTurn;

        return $this;
    }

}