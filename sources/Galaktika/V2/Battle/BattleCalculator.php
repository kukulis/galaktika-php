<?php

namespace Galaktika\V2\Battle;

use Galaktika\V2\Data\Fleet;

class BattleCalculator
{
    const MAX_TURNS = 100;

    public static function battle(Fleet $fleetA, Fleet $fleetB, RandomSequence $randomSequence): BattleReport
    {
        $battleReport = new BattleReport();

        $shipsHolder = new ShipsHolder($fleetA->getShips(), $fleetB->getShips());

        $turn = 0;

        while ($turn < self::MAX_TURNS && $shipsHolder->getACount() > 0 && $shipsHolder->getBCount() > 0) {
            // TODO

            $turn++;
        }


        $rezFleetA = clone $fleetA;
        $rezFleetB = clone $fleetB;
        $rezFleetA->setShips($shipsHolder->extractA());
        $rezFleetB->setShips($shipsHolder->extractB());

        $battleReport->setFleetA($rezFleetA);
        $battleReport->setFleetB($rezFleetB);

        return $battleReport;
    }
}