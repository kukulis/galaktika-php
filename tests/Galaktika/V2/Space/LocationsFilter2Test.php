<?php

namespace Tests\Galaktika\V2\Space;

use Galaktika\V2\Build\UniverseBuilder;
use Galaktika\V2\Data\MarkedLocation;
use PHPUnit\Framework\TestCase;

class LocationsFilter2Test extends TestCase
{
    /**
     * @param MarkedLocation[] $locations
     * @dataProvider provideLocations
     */
    public function testFilterFromFile(array $locations) {
        echo sprintf("initial locations %s", count($locations) );

        $universeBuilder  = new UniverseBuilder(99 );
        $universeBuilder->disableByDistance($locations, 3);

        // validate

        $enabledLocations = array_filter($locations, fn($l)=>$l->isEnabled());

        foreach ($enabledLocations as $l1) {
            foreach ($enabledLocations as $l2) {
                if ($l1 === $l2) {
                    continue;
                }

                $this->assertGreaterThan(
                    3,
                    $l1->distance($l2),

                    sprintf(
                        'Location 1: %s %s ; location 2: %s %s .',
                        $l1->getX(),
                        $l1->getY(),
                        $l2->getX(),
                        $l2->getY(),
                    )
                );
            }
        }

    }

    public function provideLocations() : array {
        return [
           'test1' => [
               'locations' => unserialize( file_get_contents(__DIR__.'/Data/locations.txt') )
           ]
        ];
    }

}