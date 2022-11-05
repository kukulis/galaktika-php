<?php

namespace Tests\Unit\Battle;

use Galaktika\Action\FleetsGrouper;
use Galaktika\Data\Fleet;
use Galaktika\Data\Location;
use PHPUnit\Framework\TestCase;

class FleetsGroupingTest extends TestCase
{
    public function testGroupInSameLocation()
    {
        $fleets = [
            Fleet::buildWithLocation(Location::build(10, 10)),
            Fleet::buildWithLocation(Location::build(10, 10)),
        ];

        $groupedFleets = FleetsGrouper::groupFleets($fleets);

        $this->assertCount(1, $groupedFleets);

        $this->assertArrayHasKey('10.00000:10.00000', $groupedFleets);
        $this->assertCount(2, $groupedFleets['10.00000:10.00000']);
    }

    public function testGroupInDifferentLocations() {
        $fleets = [
            Fleet::buildWithLocation(Location::build(10, 10)),
            Fleet::buildWithLocation(Location::build(11, 11)),
        ];

        $groupedFleets = FleetsGrouper::groupFleets($fleets);

        $this->assertCount(2, $groupedFleets);

        $this->assertArrayHasKey('10.00000:10.00000', $groupedFleets);
        $this->assertCount(1, $groupedFleets['10.00000:10.00000']);

        $this->assertArrayHasKey('11.00000:11.00000', $groupedFleets);
        $this->assertCount(1, $groupedFleets['11.00000:11.00000']);

    }

    public function testGroupInFourLocations() {
        $fleets = [
            Fleet::buildWithLocation(Location::build(10, 10)),
            Fleet::buildWithLocation(Location::build(11, 11)),
            Fleet::buildWithLocation(Location::build(10, 10)),
            Fleet::buildWithLocation(Location::build(11, 11)),
        ];

        $groupedFleets = FleetsGrouper::groupFleets($fleets);
        $this->assertCount(2, $groupedFleets);

        $this->assertArrayHasKey('10.00000:10.00000', $groupedFleets);
        $this->assertCount(2, $groupedFleets['10.00000:10.00000']);

        $this->assertArrayHasKey('11.00000:11.00000', $groupedFleets);
        $this->assertCount(2, $groupedFleets['11.00000:11.00000']);

    }
}