<?php

namespace Galaktika\V2\Battle;

use Galaktika\V2\Data\Fleet;

class BattleCalculator
{
    public static function battle(Fleet $fleetA, Fleet $fleetB, RandomSequence $randomSequence): BattleReport
    {
        $battleReport = new BattleReport();

        $shipsHolder = new ShipsHolder($fleetA->getShips(), $fleetB->getShips());



        return $battleReport;
    }
}