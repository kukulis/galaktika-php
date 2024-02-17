<?php

namespace Galaktika\V2\Data;

class GameSettings
{
    private float $populationPercentage = 1.3;

    // races?

    public function getPopulationPercentage(): float
    {
        return $this->populationPercentage;
    }

    public function setPopulationPercentage(float $populationPercentage): GameSettings
    {
        $this->populationPercentage = $populationPercentage;
        return $this;
    }
}