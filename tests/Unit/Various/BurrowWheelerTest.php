<?php

namespace Tests\Unit\Util\Various;

use Galaktika\Various\BurrowWheelerTransformer;
use PHPUnit\Framework\TestCase;

class BurrowWheelerTest extends TestCase
{
    public function testEncodeFunction()
    {
        $this->assertSame(["nnbbraaaa", 4],     BurrowWheelerTransformer::encode("bananabar"));
        $this->assertSame(["e emnllbduuHB", 2], BurrowWheelerTransformer::encode("Humble Bundle"));
        $this->assertSame(["ww MYeelllloo", 1], BurrowWheelerTransformer::encode("Mellow Yellow"));
    }

    public function testDecodeFunction()
    {
        $this->assertSame("bananabar",     BurrowWheelerTransformer::decode("nnbbraaaa", 4));
        $this->assertSame("Humble Bundle", BurrowWheelerTransformer::decode("e emnllbduuHB", 2));
        $this->assertSame("Mellow Yellow", BurrowWheelerTransformer::decode("ww MYeelllloo", 1));
    }
}