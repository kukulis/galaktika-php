<?php

namespace Tests\Galaktika\V2\Production;

use Galaktika\V2\Data\PlanetSurface;
use Galaktika\V2\Production\PlanetEconomicsCalculator;
use PHPUnit\Framework\TestCase;

class BuildEconomicTest extends TestCase
{
    public function testBuildEconomics()
    {
        $planetSurface = PlanetEconomicsCalculator::buildEconomics(new PlanetSurface());
// TODO correct test
        $this->assertTrue(false);
    }
}