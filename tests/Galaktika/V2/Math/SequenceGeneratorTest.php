<?php

namespace Tests\Galaktika\V2\Math;

use Galaktika\V2\Math\SequenceGenerator;
use PHPUnit\Framework\TestCase;

class SequenceGeneratorTest extends TestCase
{

    /**
     * @dataProvider provide
     */
    public function testGenerator($size)
    {
        $randomValues = [];
        for ($i = 0; $i < $size; $i++) {
            $randomValues[] = lcg_value();
        }

        $sequence = SequenceGenerator::generate($randomValues);

        $this->assertCount($size, $sequence);

        if ($size <= 10) {
            echo sprintf("Sequence: %s", join(',', $sequence));
        }

        $uSequence = array_unique($sequence);
        $this->assertEquals($uSequence, $sequence);

        $sequence2 = SequenceGenerator::generate($randomValues);

        $this->assertEquals($sequence, $sequence2);
    }

    public function provide(): array
    {
        return [
            'test10' => [
                'size' => 10,
            ],
            'test1' => [
                'size' => 1,
            ],
            'test3' => [
                'size' => 3,
            ],
            'test100' => [
                'size' => 100,
            ],
            'test0' => [
                'size' => 0,
            ],
        ];
    }

    public function testWithRandom1() {
        $this->assertEquals([0], SequenceGenerator::generate([1]));
        $this->assertEquals([1,0], SequenceGenerator::generate([1,1]));
        $this->assertEquals([2,1,0], SequenceGenerator::generate([1,1,1]));
    }
}