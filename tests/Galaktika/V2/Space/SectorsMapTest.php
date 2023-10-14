<?php

namespace Tests\Galaktika\V2\Space;

use Galaktika\V2\Space\SectorsMap;
use PHPUnit\Framework\TestCase;

class SectorsMapTest extends TestCase
{

    public function testReboundIndex() {
        $sectorsMap = new SectorsMap(12, 3);

        $this->assertEquals(0 , $sectorsMap->reboundIndex(0));
        $this->assertEquals(1 , $sectorsMap->reboundIndex(1));
        $this->assertEquals(2 , $sectorsMap->reboundIndex(2));
        $this->assertEquals(3 , $sectorsMap->reboundIndex(3));
        $this->assertEquals(0 , $sectorsMap->reboundIndex(4));
        $this->assertEquals(3 , $sectorsMap->reboundIndex(-1));
    }

}