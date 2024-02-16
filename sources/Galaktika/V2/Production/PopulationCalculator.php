<?php

namespace Galaktika\V2\Production;

class PopulationCalculator
{
    public static function calculatePopulation(float $population, float $coefficient, float $limit) : float {
        return min ($limit, $population * $coefficient);
    }
}