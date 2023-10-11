<?php

namespace Galaktika\V2\Production;

use Galaktika\V2\Data\PlanetSurface;

class MaterialCommand implements PlanetSurfaceCommand
{
    private string  $id;
    private float $goalAmount;

    private float $madeAmount=0;

    public function execute(PlanetSurface $planetSurface): PlanetSurface
    {
        $this->madeAmount = min(
            $this->goalAmount,
            $planetSurface->getUnusedIndustry(),
            $planetSurface->getUnusedPopulation()
        );

        $planetSurface->setMaterial($planetSurface->getMaterial()+ $this->madeAmount);

        return $planetSurface;
    }

    public function getCode(): string
    {
        return self::COMMAND_MATERIAL;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): MaterialCommand
    {
        $this->id = $id;

        return $this;
    }

    public function getGoalAmount(): float
    {
        return $this->goalAmount;
    }

    public function setGoalAmount(float $goalAmount): MaterialCommand
    {
        $this->goalAmount = $goalAmount;

        return $this;
    }

    public function getMadeAmount(): float
    {
        return $this->madeAmount;
    }

    public function setMadeAmount(float $madeAmount): MaterialCommand
    {
        $this->madeAmount = $madeAmount;

        return $this;
    }

}