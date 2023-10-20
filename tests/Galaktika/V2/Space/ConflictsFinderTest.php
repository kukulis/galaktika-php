<?php

namespace Tests\Galaktika\V2\Space;

use Galaktika\V2\Data\DiplomacyMap;
use Galaktika\V2\Data\Race;
use Galaktika\V2\Data\Ship;
use Galaktika\V2\Space\ConflictFinder;
use PHPUnit\Framework\TestCase;

class ConflictsFinderTest extends TestCase
{
    public function testFind()
    {
        $ships = [
            (new Ship())
                ->setId('1')
                ->setX(10)
                ->setY(10)
                ->setOwner((new Race())->setId('111')),
            (new Ship())
                ->setId('2')
                ->setX(10)
                ->setY(10)
                ->setOwner((new Race())->setId('222')),
        ];

        $diplomacyMap = new DiplomacyMap();

        $conflicts = ConflictFinder::findConflicts($ships, $diplomacyMap);

        $this->assertCount(1, $conflicts);

        $this->assertCount(1, $conflicts[0]->getSideShips(0));
        $this->assertCount(1, $conflicts[0]->getSideShips(1));

        $this->assertEquals('1', $conflicts[0]->getSideShips(0)[0]->getId());
        $this->assertEquals('2', $conflicts[0]->getSideShips(1)[0]->getId());
    }

}