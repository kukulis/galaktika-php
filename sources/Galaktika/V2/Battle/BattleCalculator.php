<?php

namespace Galaktika\V2\Battle;

use Galaktika\V2\Data\Fleet;
use Galaktika\V2\Data\Ship;
use Galaktika\V2\Math\DestroyCalculator;
use Galaktika\V2\Math\SequenceGenerator;

class BattleCalculator
{
    private int $maxTurns=100;

    public function __construct(int $maxTurns)
    {
        $this->maxTurns = $maxTurns;
    }

    public function battle(Fleet $fleetA, Fleet $fleetB, RandomSequence $randomSequence): BattleReport
    {
        $battleReport = new BattleReport();
        $shipsHolder = new ShipsHolder($fleetA->getShips(), $fleetB->getShips());
        $turn = 0;
        while ($turn < $this->maxTurns && $shipsHolder->getAShipsCount() > 0 && $shipsHolder->getBShipsCount() > 0) {
            $allShips = $shipsHolder->extractAll();
            $shootingShips = array_values(array_filter($allShips, fn(Ship $ship) => $ship->getGuns() > 0));
            $shootersIndexes = SequenceGenerator::generate($randomSequence->nextArray(count($shootingShips)));
            /** @var Ship[] $reorderedShootingShips */
            $reorderedShootingShips = SequenceGenerator::reorder($shootingShips, $shootersIndexes);

            foreach ($reorderedShootingShips as $ship) {
                $shooterSide = 0; // 0 - A, 1 - B
                // 1) detect side
                if (($shooter = $shipsHolder->getAShipByKey($ship->getId())) != null) {
                    $shooterSide = 0;
                    $targetSide = 1;
                } else {
                    if (($shooter = $shipsHolder->getBShipByKey($ship->getId())) != null) {
                        $shooterSide = 1;
                        $targetSide = 0;
                    } else {
                        // ship destroyed already
                        continue;
                    }
                }

                for ($shoot = 0; $shoot < $shooter->getGuns(); $shoot++) {
                    $targetIndex = intval($randomSequence->next() * $shipsHolder->getSideShipsCount($targetSide));
                    $target = $shipsHolder->getSideShipByIndex($targetSide, $targetIndex);


                    $destoryed = DestroyCalculator::calculateDestroyed(
                        $shooter->getAttack(),
                        $target->getDefence(),
                        $randomSequence->next()
                    );
                    $battleReport->addShot(BattleReportLine::create($shooter, $target, $destoryed));

                    if ($destoryed) {
                        $shipsHolder->remove($target->getId());
                    }
                }
            }

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