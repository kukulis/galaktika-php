<?php

namespace Galaktika\V2\Battle;

use Galaktika\Exceptions\GalaktikaException;
use Galaktika\V2\Data\Fleet;
use Galaktika\V2\Data\Ship;
use Galaktika\V2\Math\DestroyCalculator;
use Galaktika\V2\Math\IRandomGenerator;
use Galaktika\V2\Math\SequenceGenerator;

class BattleCalculator
{
    private int $maxTurns = 100;

    public function __construct(int $maxTurns)
    {
        $this->maxTurns = $maxTurns;
    }

    public function battle(Fleet $fleetA, Fleet $fleetB, IRandomGenerator $randomSequence): BattleReport
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
                $shooterSelector = array_filter ([
                    0 => $shipsHolder->getAShipByKey($ship->getId()),
                    1 => $shipsHolder->getBShipByKey($ship->getId()),
                ]);

                if ( count($shooterSelector) > 1 ) {
                    throw new GalaktikaException(sprintf('Ship [%s] belongs to two sides!', $ship->getId()));
                }

                foreach ( $shooterSelector as $shooterSide => $shooter ) {
                    $targetSide = self::reverseSide($shooterSide);

                    for ($shoot = 0; $shoot < $shooter->getGuns(); $shoot++) {
                        $targetIndex = self::randomFloatToInt($randomSequence->next(), $shipsHolder->getSideShipsCount($targetSide));
                        $target = $shipsHolder->getSideShipByIndex($targetSide, $targetIndex);

                        $destroyed = DestroyCalculator::calculateDestroyed(
                            $shooter->getAttack(),
                            $target->getDefence(),
                            $randomSequence->next()
                        );
                        $battleReport->addShot(BattleReportLine::create($shooter, $target, $destroyed));

                        if ($destroyed) {
                            // mark target as shot
                            $target->setDestroyed(true);
                            $shipsHolder->remove($target->getId());
                        }
                    }
                }
            }

            $turn++;
        }

        $rezFleetA = clone $fleetA;
        $rezFleetB = clone $fleetB;
        $rezFleetA->setShips($shipsHolder->extractA());
        $rezFleetB->setShips($shipsHolder->extractB());

        $battleReport->setBeforeFleetA($fleetA);
        $battleReport->setBeforeFleetB($fleetB);
        $battleReport->setFleetA($rezFleetA);
        $battleReport->setFleetB($rezFleetB);

        return $battleReport;
    }

    public static function reverseSide(int $side) {
        if ( $side == 0 ) {
            return 1;
        }

        return 0;
    }

    public static function randomFloatToInt( float $random, int $max) : int {
        $value =  intval($random * $max);

        if ( $value >= $max ) {
            return $max-1;
        }

        return $value;
    }
}