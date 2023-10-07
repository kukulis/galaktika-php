<?php

namespace Tests\Galaktika\V2\Battle;

use Galaktika\V2\Battle\BattleCalculator;
use Galaktika\V2\Battle\RandomSequence;
use Galaktika\V2\Data\Fleet;
use Galaktika\V2\Data\Ship;
use PHPUnit\Framework\TestCase;

class MaxTurnsBattleTest extends TestCase
{

    public function testMaxTurns()
    {
        $fleetA = new Fleet();
        $fleetB = new Fleet();

        $fleetA->addShip((new Ship())->setId(uniqid())->setGuns(1)->setAttack(1)->setDefence(4));
        $fleetB->addShip((new Ship())->setId(uniqid())->setGuns(1)->setAttack(1)->setDefence(4));

        $maxTurns = 5;

        // 2 amount of ships
        // 3 - required randoms for each shot
        $randoms = array_fill(0, $maxTurns * 2 * 3, 1);

        $randomSequence = new RandomSequence($randoms);
        $battleCalculator = new BattleCalculator($maxTurns);
        $battleReport = $battleCalculator->battle($fleetA, $fleetB, $randomSequence);

        $this->assertCount(1, $battleReport->getFleetA()->getShips());
        $this->assertCount(1, $battleReport->getFleetB()->getShips());

        $this->assertCount(10, $battleReport->getShots());
    }

}