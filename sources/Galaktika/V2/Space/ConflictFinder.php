<?php

namespace Galaktika\V2\Space;

use Galaktika\Util\Grouper;
use Galaktika\V2\Battle\Conflict;
use Galaktika\V2\Data\IDiplomacyMap;
use Galaktika\V2\Data\Ship;

class ConflictFinder
{
    /**
     * @param Ship[] $ships
     * @return Conflict[]
     */
    public static function findConflicts(array $ships, IDiplomacyMap $diplomacyMap): array
    {
        /** @var Ship[][] $groupedShips */
        $groupedShips = Grouper::group($ships, fn(Ship $ship) => $ship->getLocationKey());

        /** @var Conflict[] $conflicts */
        $conflicts = [];

        foreach ($groupedShips as $shipsGroup) {
            $conflict = new Conflict();
            $oneSideOwner = $shipsGroup[0]->getOwner();

            foreach ($shipsGroup as $ship) {
                $relation = $diplomacyMap->getRelation($oneSideOwner, $ship->getOwner());

                $side = 0;
                if ($relation == IDiplomacyMap::ENEMY) {
                    $side = 1;
                }

                $conflict->addShip($side, $ship);
            }

            if (count($conflict->getSideShips(1)) != 0) {
                $conflicts[] = $conflict;
            }
        }

        return $conflicts;
    }
}