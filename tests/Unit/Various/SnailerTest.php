<?php

namespace Tests\Unit\Util\Various;

use Galaktika\Various\Snailer;
use PHPUnit\Framework\TestCase;

class SnailerTest extends TestCase
{

    public function testDescriptionExamples() {
        $this->assertSame([1, 2, 3, 6, 9, 8, 7, 4, 5], Snailer::snail([
            [1, 2, 3],
            [4, 5, 6],
            [7, 8, 9]
        ]));
        $this->assertSame([1, 2, 3, 4, 5, 6, 7, 8, 9], Snailer::snail([
            [1, 2, 3],
            [8, 9, 4],
            [7, 6, 5]
        ]));
        $this->assertSame([1, 2, 3, 1, 4, 7, 7, 9, 8, 7, 7, 4, 5, 6, 9, 8], Snailer::snail([
            [1, 2, 3, 1],
            [4, 5, 6, 4],
            [7, 8, 9, 7],
            [7, 8, 9, 7]
        ]));
        $this->assertSame([], Snailer::snail([[]]), 'Your solution should also work properly for an empty matrix');
    }
}