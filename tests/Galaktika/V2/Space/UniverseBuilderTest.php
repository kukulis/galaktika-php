<?php

namespace Tests\Galaktika\V2\Space;

use Galaktika\V2\Build\UniverseBuilder;
use Galaktika\V2\Data\Race;
use PHPUnit\Framework\TestCase;

class UniverseBuilderTest extends TestCase
{
    public function testBuildUniverse()
    {
        $universeBuilder = new UniverseBuilder(99, 1, 3);


        $racesCount = 100;
        $races = [];
        for ($r = 0; $r < $racesCount; $r++) {
            $races[] = new Race();
        }

        $universe = $universeBuilder->buildUniverse($races, 1, 3, 99, 1000);

        $surfaces = $universe->getPlanetSurfaces();
        $this->assertCount($racesCount, $surfaces);


        foreach ($surfaces as $surface1) {
            foreach ($surfaces as $surface2) {
                if ($surface1 === $surface2) {
                    continue;
                }

                $this->assertGreaterThan(
                    3,
                    $surface1->getPlanet()->getLocation()->distance($surface2->getPlanet()->getLocation()),

                    sprintf(
                        'Planet 1: %s %s ; planet 2: %s %s .',
                        $surface1->getPlanet()->getLocation()->getX(),
                        $surface1->getPlanet()->getLocation()->getY(),
                        $surface2->getPlanet()->getLocation()->getX(),
                        $surface2->getPlanet()->getLocation()->getY(),
                    )
                );
            }
        }
    }

}