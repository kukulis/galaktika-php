<?php

namespace Tests\Galaktika\V2\Production;

use Galaktika\V2\Data\Planet;
use Galaktika\V2\Production\PlanetBuildCalculator;
use PHPUnit\Framework\TestCase;

class BuildEconomicTest extends TestCase
{
    public function testBuildEconomics()
    {
        $planet = PlanetBuildCalculator::buildShips(new Planet());
// TODO correct test
        $this->assertTrue(false);
    }
}