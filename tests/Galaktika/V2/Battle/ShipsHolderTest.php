<?php

namespace Tests\Galaktika\V2\Battle;

use Galaktika\V2\Battle\ShipsHolder;
use Galaktika\V2\Data\Ship;
use PHPUnit\Framework\TestCase;

class ShipsHolderTest extends TestCase
{
    public function testShipsHolder() {

        $aShips = [
            (new Ship())->setId('ship11'),
            (new Ship())->setId('ship12'),
        ];

        $bShips = [
            (new Ship())->setId('ship21'),
            (new Ship())->setId('ship22'),
        ];


        $shipsHolder = new ShipsHolder($aShips, $bShips);

        $shipsHolder->remove('ship21');

        $this->assertEquals(3, $shipsHolder->getCount());
        $this->assertEquals(2, $shipsHolder->getAShipsCount());
        $this->assertEquals(1, $shipsHolder->getBShipsCount());
        $this->assertEquals(3, $shipsHolder->getIdCount());
        $this->assertEquals(2, $shipsHolder->getAShipsIdsCount());
        $this->assertEquals(1, $shipsHolder->getBShipsIdsCount());

        $shipsHolder->remove('ship21');
        $this->assertEquals(3, $shipsHolder->getCount());
        $this->assertEquals(2, $shipsHolder->getAShipsCount());
        $this->assertEquals(1, $shipsHolder->getBShipsCount());
        $this->assertEquals(3, $shipsHolder->getIdCount());
        $this->assertEquals(2, $shipsHolder->getAShipsIdsCount());
        $this->assertEquals(1, $shipsHolder->getBShipsIdsCount());

        $shipsHolder->remove('ship11');
        $this->assertEquals(2, $shipsHolder->getCount());
        $this->assertEquals(1, $shipsHolder->getAShipsCount());
        $this->assertEquals(1, $shipsHolder->getBShipsCount());
        $this->assertEquals(2, $shipsHolder->getIdCount());
        $this->assertEquals(1, $shipsHolder->getAShipsIdsCount());
        $this->assertEquals(1, $shipsHolder->getBShipsIdsCount());

        $shipsHolder->remove('ship11');
        $this->assertEquals(2, $shipsHolder->getCount());
        $this->assertEquals(1, $shipsHolder->getAShipsCount());
        $this->assertEquals(1, $shipsHolder->getBShipsCount());
        $this->assertEquals(2, $shipsHolder->getIdCount());
        $this->assertEquals(1, $shipsHolder->getAShipsIdsCount());
        $this->assertEquals(1, $shipsHolder->getBShipsIdsCount());

    }
}