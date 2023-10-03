<?php

namespace Tests\Galaktika\V2\Production;

use Galaktika\V2\Data\Planet;
use Galaktika\V2\Production\PlanetBuildCalculator;
use PHPUnit\Framework\TestCase;

class BuildShipsTest extends TestCase
{
    public function testBuildShips() {
        $planet = PlanetBuildCalculator::buildShips(new Planet());
// TODO correct test
        $this->assertTrue(false);
    }
}