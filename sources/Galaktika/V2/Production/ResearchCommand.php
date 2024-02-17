<?php

namespace Galaktika\V2\Production;

use Galaktika\Exceptions\GalaktikaException;
use Galaktika\V2\Data\PlanetSurface;

class ResearchCommand implements PlanetSurfaceCommand
{
    public const TECHNOLOGY_COEFFICIENT = 0.01;

    private float $goalAmount = 99999;
    private string $technologyType;

    public function execute(PlanetSurface $planetSurface, PlanetSurface $oldSurface, int $turn): void
    {
        $technologies = $planetSurface->getOwner()->getTechnologies($turn);

        if ($technologies == null) {
            // try to get technologies from the previous turn
            $prevTechnologies = $planetSurface->getOwner()->getTechnologies($turn - 1);

            if ($prevTechnologies == null) {
                throw new GalaktikaException(
                    sprintf(
                        'Cant get technologies for race %s from turn %s neither %s',
                        $planetSurface->getOwner()->getId(),
                        $turn - 1,
                        $turn
                    )
                );
            }

            $technologies = clone $prevTechnologies;
            $planetSurface->getOwner()->setTechnologies($technologies, $turn);
        }

        $usedPower = min(
            $this->goalAmount,
            $planetSurface->getUnusedIndustry(),
            $planetSurface->getUnusedPopulation()
        );

        $technologyGrowth = $usedPower * self:: TECHNOLOGY_COEFFICIENT;

        $technologies->setTechnology(
            $this->technologyType,
            $technologies->getTechnology($this->technologyType) + $technologyGrowth
        );
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