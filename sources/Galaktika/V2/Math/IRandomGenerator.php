<?php

namespace Galaktika\V2\Math;

interface IRandomGenerator
{
    public const ALMOST1 = 0.999999;

    public function next(): float;

    /**
     * @return float[]
     */
    public function nextArray(int $count): array;
}