<?php

namespace Tests\Unit\Util\Various;

use Galaktika\Various\Towns;
use PHPUnit\Framework\TestCase;

class BestTravelTest extends TestCase {
    private function revTest($actual, $expected) {
        $this->assertSame($expected, $actual);
    }
    public function testCountOnesBasics() {
        $ts = [50, 55, 56, 57, 58];
        $this->revTest(Towns::chooseBestSum(163, 3, $ts), 163);
        $ts = [50];
        $this->revTest(Towns::chooseBestSum(163, 3, $ts), null);
        $ts = [91, 74, 73, 85, 73, 81, 87];
        $this->revTest(Towns::chooseBestSum(230, 3, $ts), 228);
    }
}