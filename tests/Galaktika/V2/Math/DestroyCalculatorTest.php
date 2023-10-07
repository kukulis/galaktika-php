<?php

namespace Tests\Galaktika\V2\Math;

use Galaktika\V2\Math\DestroyCalculator;
use PHPUnit\Framework\TestCase;

class DestroyCalculatorTest extends TestCase
{
    /**
     * @dataProvider provide
     */
    public function testDestroyed(float $attack, float $defence, float $randomFactor, bool $expectedDestroyed)
    {
        $this->assertEquals(
            $expectedDestroyed,
            DestroyCalculator::calculateDestroyed($attack, $defence, $randomFactor)
        );
    }

    public function provide(): array
    {
        return [
            'test1' => [
                'attack' => 1,
                'defence' => 1,
                'randomFactor' => 1,
                'expectedDestroyed' => true,
            ],
            'test2' => [
                'attack' => 1,
                'defence' => 1,
                'randomFactor' => 0.49,
                'expectedDestroyed' => false,
            ],
            'test3' => [
                'attack' => 1,
                'defence' => 3,
                'randomFactor' => 1,
                'expectedDestroyed' => true,
            ],
            'test never destroyed' => [
                'attack' => 1,
                'defence' => 4,
                'randomFactor' => 1,
                'expectedDestroyed' => false,
            ],
            'test never destroyed 2' => [
                'attack' => 2,
                'defence' => 10,
                'randomFactor' => 1,
                'expectedDestroyed' => false,
            ],
            'test always destroyed' => [
                'attack' => 4,
                'defence' => 1,
                'randomFactor' => 0,
                'expectedDestroyed' => true,
            ],
            'test always destroyed 2' => [
                'attack' => 10,
                'defence' => 2,
                'randomFactor' => 0,
                'expectedDestroyed' => true,
            ],
            'nearly destroyed' => [
                'attack' => 1,
                'defence' => 3.9,
                'randomFactor' => 1,
                'expectedDestroyed' => true,
            ],
            'nearly not destroyed' => [
                'attack' => 1,
                'defence' => 3.9,
                'randomFactor' => 0.9,
                'expectedDestroyed' => false,
            ],

            'nearly defended' => [
                'attack' => 3.9,
                'defence' => 1,
                'randomFactor' => 0.001,
                'expectedDestroyed' => false,
            ],
            'nearly not defended' => [
                'attack' => 3.9,
                'defence' => 1,
                'randomFactor' => 0.1,
                'expectedDestroyed' => true,
            ],
            'zero defence' => [
                'attack' => 1,
                'defence' => 0,
                'randomFactor' => 0,
                'expectedDestroyed' => true,
            ],

        ];
    }

}