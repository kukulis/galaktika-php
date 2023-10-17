<?php

namespace Tests\Galaktika\V2\Space;

use Galaktika\V2\Build\UniverseBuilder;
use Galaktika\V2\Data\MarkedLocation;
use PHPUnit\Framework\TestCase;

class LocationsFilterTest extends TestCase
{
    public function testFilter()
    {
        // Planet 1:  ; planet 2:  .

        $locations = [
            new MarkedLocation(13.404104373222, 55.405750666302),
            new MarkedLocation(11.474330270953, 53.148695921496),
        ];

        $universeBuilder  = new UniverseBuilder(99 );
        $universeBuilder->disableByDistance($locations, 3);

        $this->assertTrue($locations[0]->isEnabled());
        $this->assertFalse($locations[1]->isEnabled());
    }



}