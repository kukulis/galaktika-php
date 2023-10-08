<?php

namespace Tests\Galaktika\V2\Production;

use Galaktika\V2\Data\PlanetSurface;
use Galaktika\V2\Production\PlanetBuildCalculator;
use PHPUnit\Framework\TestCase;

class BuildShipsTest extends TestCase
{
    public function testBuildShips()
    {
        $planetSurface = PlanetBuildCalculator::buildShips(new PlanetSurface());
// TODO correct test
        $this->assertTrue(false);
    }
}