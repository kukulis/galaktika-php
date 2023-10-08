<?php

namespace Galaktika\V2\Production;

use Galaktika\V2\Data\PlanetSurface;

class IndustryCommand implements PlanetSurfaceCommand
{
    private string  $id;
    private float $goalAmount;

    private float $madeAmount=0;

    public function execute(PlanetSurface $planetSurface): PlanetSurface
    {

        $industryFromMaterial = min($planetSurface->getMaterial(), $this->goalAmount - $this->madeAmount, $planetSurface->getUnusedPopulation());
        $planetSurface->setUsedPopulation( $planetSurface->getUsedPopulation() + $industryFromMaterial );
        $planetSurface->setMaterial($planetSurface->getMaterial() - $industryFromMaterial);

        $this->madeAmount += $industryFromMaterial;

        if ( $this->madeAmount == $this->goalAmount) {
            return $planetSurface;
        }

        $industryFromIndustry = min ( $this->goalAmount-$this->madeAmount, $planetSurface->getUnusedPopulation(), $planetSurface->getUnusedIndustry());
        $planetSurface->setUsedPopulation( $planetSurface->getUsedPopulation() + $industryFromIndustry );
        $planetSurface->setUsedIndustry( $planetSurface->getUsedIndustry() + $industryFromIndustry );

        $this->madeAmount += $industryFromIndustry;


        return $planetSurface;
    }

    public function getCode(): string
    {
        return self::COMMAND_INDUSTRY;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): IndustryCommand
    {
        $this->id = $id;

        return $this;
    }

    public function getGoalAmount(): float
    {
        return $this->goalAmount;
    }

    public function setGoalAmount(float $goalAmount): IndustryCommand
    {
        $this->goalAmount = $goalAmount;

        return $this;
    }

    public function getMadeAmount(): float|int
    {
        return $this->madeAmount;
    }

    public function setMadeAmount(float|int $madeAmount): IndustryCommand
    {
        $this->madeAmount = $madeAmount;

        return $this;
    }

}