<?php

namespace Tests\Galaktika\V2\Production;

use Galaktika\V2\Data\PlanetSurface;
use Galaktika\V2\Production\PlanetEconomicsCalculator;
use PHPUnit\Framework\TestCase;

class BuildEconomicTest extends TestCase
{
    public function testBuildEconomics()
    {
        $planetSurface = new PlanetSurface();

        $planetSurface->setId(uniqid());
        $planetSurface->setIndustry(100);
        $planetSurface->setPopulation(100);


        $rezPlanetSurface = PlanetEconomicsCalculator::buildEconomics($planetSurface);
// TODO correct test
        $this->assertTrue(false);
    }
}