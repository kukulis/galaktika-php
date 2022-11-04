<?php

namespace Galaktika\Repositories;

use Galaktika\Data\Battle;
use Galaktika\Data\GameTurn;

interface BattlesRepository
{
    public function addBattle(Battle $battle, GameTurn $gameTurn);

    public function getBattles(BattlesFilter $battlesFilter) : array;
}