<?php

namespace Tests\Unit\Util;

use Galaktika\Util\PairsIterator;
use PHPUnit\Framework\TestCase;

class PairsIteratorTest extends TestCase
{
    public function testPairs()
    {
        $elements = [1, 2, 3];

        $iterator = new PairsIterator($elements);

        $results = [];
        while ($iterator->next()) {
            $results[] = [$iterator->getA(), $iterator->getB()];
        }

        $this->assertEquals(
            [[1, 2], [1, 3], [2, 3]],
            $results
        );
    }

    public function testPairsLetters()
    {
        $elements = ['a', 'b', 'c', 'd'];

        $iterator = new PairsIterator($elements);

        $results = [];
        while ($iterator->next()) {
            $results[] = [$iterator->getA(), $iterator->getB()];
        }

        $this->assertEquals(
            [
                ['a', 'b'],
                ['a', 'c'],
                ['a', 'd'],
                ['b', 'c'],
                ['b', 'd'],
                ['c', 'd'],
            ],
            $results
        );
    }

    public function testOne() {
        $iterator = new PairsIterator([1]);

        $results = [];
        while ($iterator->next()) {
            $results[] = [$iterator->getA(), $iterator->getB()];
        }

        $this->assertCount(0, $results);
    }

    public function testZero() {
        $iterator = new PairsIterator([]);
        $results = [];
        while ($iterator->next()) {
            $results[] = [$iterator->getA(), $iterator->getB()];
        }

        $this->assertCount(0, $results);
    }
}