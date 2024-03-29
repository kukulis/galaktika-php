<?php

namespace Tests\Galaktika\V2\Battle;

use Galaktika\V2\Battle\BattleCalculator;
use Galaktika\V2\Battle\RandomSequence;
use Galaktika\V2\Data\Fleet;
use Galaktika\V2\Data\Ship;
use PHPUnit\Framework\TestCase;

class BattleSimpleTest extends TestCase
{
    public function testBattle()
    {
        $fleetA = new Fleet();
        $fleetB = new Fleet();

        $fleetA->addShip((new Ship())->setId(uniqid())->setGuns(0)->setDefence(0));
        $fleetB->addShip((new Ship())->setId(uniqid())->setGuns(1)->setAttack(1));

        $randomSequence = new RandomSequence([1,1,1,1,1,1,1,1]);

        $battleCalculator = new BattleCalculator(100);
        $battleReport = $battleCalculator->battle($fleetA, $fleetB, $randomSequence);

        $this->assertCount(0, $battleReport->getFleetA()->getShips());
        $this->assertCount(1, $battleReport->getFleetB()->getShips());

        $this->assertCount(1, $battleReport->getShots());
    }

}