<?php

namespace Tests\Unit\Util\Various;

use Galaktika\Various\Josephus;
use PHPUnit\Framework\TestCase;

class JosephusTest extends TestCase
{
    public function testExamples() {
        $this->assertSame(4, Josephus::josephus_survivor(7, 3));
        $this->assertSame(10, Josephus::josephus_survivor(11, 19));
        $this->assertSame(1, Josephus::josephus_survivor(1, 300));
        $this->assertSame(13, Josephus::josephus_survivor(14, 2));
        $this->assertSame(100, Josephus::josephus_survivor(100, 1));
    }
}