<?php

namespace Tests\Unit\Util\Various;

use Galaktika\Various\Towns;
use PHPUnit\Framework\TestCase;

class TownsNextTest extends TestCase
{
    public function testNext() {
        $ii = Towns::init(3);
        $this->assertEquals([0,1,2], $ii);

        $ii = Towns::next($ii, 5);
        $this->assertEquals([0,1,3], $ii );

        $ii = Towns::next($ii, 5);
        $this->assertEquals([0,1,4], $ii );

        $ii = Towns::next($ii, 5);
        $this->assertEquals([0,2,3], $ii );

        $ii = Towns::next($ii, 5);
        $this->assertEquals([0,2,4], $ii );

        $ii = Towns::next($ii, 5);
        $this->assertEquals([0,3,4], $ii );

        $ii = Towns::next($ii, 5);
        $this->assertEquals([1,2,3], $ii );

        $ii = Towns::next($ii, 5);
        $this->assertEquals([1,2,4], $ii );

        $ii = Towns::next($ii, 5);
        $this->assertEquals([1,3,4], $ii );

        $ii = Towns::next($ii, 5);
        $this->assertEquals([2,3,4], $ii );

        $ii = Towns::next($ii, 5);
        $this->assertNull( $ii );

    }

}