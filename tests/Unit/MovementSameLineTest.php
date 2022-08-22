<?php

namespace Tests\Unit;

use Galaktika\Data\Location;
use Galaktika\Data\Movement;
use PHPUnit\Framework\TestCase;

class MovementSameLineTest extends TestCase
{
    public function testSameLine() {

        $movement1 = Movement::build(Location::build(0,0), Location::build(1,1));
        $movement2 = Movement::build(Location::build(2,2), Location::build(3,3));

        $this->assertTrue ( $movement1->sameLine($movement2) );
        $this->assertTrue ( $movement2->sameLine($movement1) );

        $movement3 = Movement::build(Location::build(0,0), Location::build(1,2));
        $movement4 = Movement::build(Location::build(1,2), Location::build(2,4));

        $this->assertTrue ( $movement3->sameLine($movement4));
        $this->assertFalse ( $movement1->sameLine( $movement3 ));

    }

    public function testSameLineVertical() {
        // vertical
        $movement5 = Movement::build(Location::build(10,0), Location::build(10,10));
        $movement6 = Movement::build(Location::build(10,-1), Location::build(10,-11));

        $this->assertTrue($movement5->sameLine($movement6));
    }

    public function testSameLineHorizontal() {
        $movement5 = Movement::build(Location::build(10,10), Location::build(5,10));
        $movement6 = Movement::build(Location::build(-10,10), Location::build(-5,10));

        $this->assertTrue($movement5->sameLine($movement6));
    }

    public function testStayingStill() {
        $movement5 = Movement::build(Location::build(10,10), Location::build(10,10));
        $movement6 = Movement::build(Location::build(20,20), Location::build(20,20));

        $this->assertFalse($movement5->sameLine($movement6));
    }
}