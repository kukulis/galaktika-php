<?php

namespace Galaktika\V2\Production;

use Galaktika\V2\Data\PlanetSurface;

class ResearchCommand implements PlanetSurfaceCommand
{
    public const TECHNOLOGY_COEFFICIENT = 100;

    private float $goalAmount;
    private string $technologyType;

    public function execute(PlanetSurface $planetSurface): PlanetSurface
    {
        $technologies = $planetSurface->getOwner()->getTechnologies();

        $usedPower = min (
            $this->goalAmount,
            $planetSurface->getUnusedIndustry(),
            $planetSurface->getUnusedPopulation()
        );

        $technologyGrowth = $usedPower / self:: TECHNOLOGY_COEFFICIENT;
        $technologies->setTechnology($this->technologyType, $technologyGrowth);

        return $planetSurface;
    }

    public function getCode(): string
    {
        return self::COMMAND_RESEARCH;
    }

    public function getGoalAmount(): float
    {
        return $this->goalAmount;
    }

    public function setGoalAmount(float $goalAmount): ResearchCommand
    {
        $this->goalAmount = $goalAmount;

        return $this;
    }

    public function getTechnologyType(): string
    {
        return $this->technologyType;
    }

    public function setTechnologyType(string $technologyType): ResearchCommand
    {
        $this->technologyType = $technologyType;

        return $this;
    }
}