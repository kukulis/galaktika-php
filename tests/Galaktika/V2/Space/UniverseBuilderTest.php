<?php

namespace Tests\Galaktika\V2\Space;

use Galaktika\V2\Build\UniverseBuilder;
use Galaktika\V2\Data\Race;
use PHPUnit\Framework\TestCase;

class UniverseBuilderTest extends TestCase
{
    public function testBuildUniverse() {
        $universeBuilder = new UniverseBuilder();


        $racesCount = 10;
        $races = [];
        for($r =0; $r <$racesCount; $r++) {
            $races[] = new Race();
        }

        $universe = $universeBuilder->buildUniverse($races, 1, 3,  99, 1000);

        $surfaces = $universe->getPlanetSurfaces();
        $this->assertCount($racesCount, $surfaces);
    }

}