<?php

namespace Galaktika\V2\Production;

use Galaktika\V2\Data\PlanetSurface;

class IndustryCommand implements PlanetSurfaceCommand
{
    private string  $id;
    private float $goalAmount;

    private float $madeAmount=0;

    public function execute(PlanetSurface $planetSurface, PlanetSurface $oldSurface): void
    {

        $industryFromMaterial = min($planetSurface->getMaterial(),
            $this->goalAmount - $this->madeAmount,
            $planetSurface->getUnusedPopulation(),
            $planetSurface->getPlanet()->getSize()-$planetSurface->getIndustry()
        );
        $planetSurface->setUsedPopulation( $planetSurface->getUsedPopulation() + $industryFromMaterial );
        $planetSurface->setMaterial($planetSurface->getMaterial() - $industryFromMaterial);
        $planetSurface->setIndustry($planetSurface->getIndustry()+$industryFromMaterial);

        $this->madeAmount += $industryFromMaterial;

        if ( $this->madeAmount == $this->goalAmount) {
            return;
        }

        $industryFromIndustry = min (
            $this->goalAmount-$this->madeAmount,
            $planetSurface->getUnusedPopulation(),
            $planetSurface->getUnusedIndustry(),
            $planetSurface->getPlanet()->getSize()-$planetSurface->getIndustry()
        );
        $planetSurface->setUsedPopulation( $planetSurface->getUsedPopulation() + $industryFromIndustry );
        $planetSurface->setUsedIndustry( $planetSurface->getUsedIndustry() + $industryFromIndustry );
        $planetSurface->setIndustry($planetSurface->getIndustry()+$industryFromIndustry);

        $this->madeAmount += $industryFromIndustry;
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

    public function getMadeAmount(): float
    {
        return $this->madeAmount;
    }

    public function setMadeAmount(float $madeAmount): IndustryCommand
    {
        $this->madeAmount = $madeAmount;

        return $this;
    }

}