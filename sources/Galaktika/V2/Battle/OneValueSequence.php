<?php

namespace Galaktika\V2\Battle;

use Galaktika\V2\Math\IRandomGenerator;

class OneValueSequence implements IRandomGenerator
{
    private float $value;

    /**
     * @param float $value
     */
    public function __construct(float $value)
    {
        $this->value = $value;
    }

    public function next(): float
    {
        return $this->value;
    }

    public function nextArray(int $count): array
    {
        return array_fill(0, $count, $this->value);
    }
}