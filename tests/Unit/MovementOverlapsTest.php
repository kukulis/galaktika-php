<?php

namespace Tests\Unit;

use Galaktika\Data\Location;
use Galaktika\Data\Movement;
use PHPUnit\Framework\TestCase;

class MovementOverlapsTest extends TestCase
{
    public function testOverlaps()
    {
        $movement1 = Movement::build(Location::build(0, 0), Location::build(2, 2));
        $movement2 = Movement::build(Location::build(1, 1), Location::build(3, 3));
        $movement3 = Movement::build(Location::build(4, 4), Location::build(5, 5));

        $this->assertTrue($movement1->overlaps($movement2));
        $this->assertFalse($movement1->overlaps($movement3));

        $meetingPoint = $movement1->meetingPoint($movement2);

        $this->assertEquals(1.5, $meetingPoint->getX());
        $this->assertEquals(1.5, $meetingPoint->getY());
    }
}