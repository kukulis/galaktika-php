<?php

namespace Tests\Unit\Util\Various;

use Galaktika\Various\VovelsCounter;
use PHPUnit\Framework\TestCase;

class VovelsCounterTest extends TestCase
{
    public function testBasics() {
        $this->assertSame(5, VovelsCounter::getCount("abracadabra"));
    }
}