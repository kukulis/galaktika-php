<?php

namespace Galaktika\Action;

use Galaktika\Data\Battle;
use Galaktika\Data\Fleet;
use Galaktika\Repositories\RelationsRepository;
use Galaktika\Util\Grouper;
use Galaktika\Util\PairsIterator;

class BattlesRegisterUtility
{
    public function registerBattlesForFleets(array $fleets, RelationsRepository $relations)  : array {
        // 1) check with the same loacations
        /** @var Fleet[][] $groupedFleetsByLocations */
        $groupedFleetsByLocations = Grouper::group($fleets, fn(Fleet $fleet) => $fleet->getCurrentLocation()->getKey());

        $battles = [];

        foreach ( $groupedFleetsByLocations as $fleetsGroup ) {

            $fleetPairsIterator = new PairsIterator($fleetsGroup);

            while ( $fleetPairsIterator->next()) {
                /** @var Fleet $fleetA */
                $fleetA = $fleetPairsIterator->getA();
                /** @var Fleet $fleetB */
                $fleetB = $fleetPairsIterator->getB();
                if ( $relations->areFleetsInWar($fleetA, $fleetB) ) {
                    $battles[] = new Battle($fleetA, $fleetB);
                }
            }
        }

        return $battles;
    }
}