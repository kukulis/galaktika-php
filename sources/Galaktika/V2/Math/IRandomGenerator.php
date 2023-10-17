<?php

namespace Galaktika\V2\Math;

interface IRandomGenerator
{
    public function next(): float;

    /**
     * @return float[]
     */
    public function nextArray(int $count): array;
}