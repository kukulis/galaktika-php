<?php

namespace Test\Draft;

use PHPUnit\Framework\TestCase;
use Symfony\Component\Uid\UuidV6;

class TestUuid extends TestCase
{
    public function testGenerate() {
        $key = UuidV6::generate();
        echo $key."\n";

        $this->assertEquals(36, strlen($key));
    }
}