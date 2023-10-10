<?php

namespace Galaktika\V2\Production;

use Galaktika\V2\Data\PlanetSurface;

class ShipCommand implements PlanetSurfaceCommand
{
    private ShipModel $modelToBuild;
    private int $targetAmount;

    private int $madeAmount = 0;

    public function execute(PlanetSurface $planetSurface): PlanetSurface
    {
        $resultSurface = clone $planetSurface;
        $unfinishedShip = $resultSurface->findUnfinishedShipByModelId($this->modelToBuild->getId());
        $shipMass = $this->modelToBuild->getMass();

        $unfinishedResources = 0;
        if ($unfinishedShip != null) {
            $unfinishedResources = $unfinishedShip->getResourcesUsed();
        }

        $availableResources = min(
            $planetSurface->getMaterial(),
            $planetSurface->getUnusedIndustry(),
            $planetSurface->getUnusedPopulation()
        );

        $virtualResources = $unfinishedResources + $availableResources;
        $possibleBuildShips = intval($virtualResources / $shipMass);
        $this->madeAmount = min($possibleBuildShips, $this->targetAmount);

        if ($possibleBuildShips >= $this->targetAmount) {
            $usedResources = $shipMass * $this->targetAmount - $unfinishedResources;
            $resultSurface->removeUnfinishedShip($unfinishedShip);
        } else {
            $usedResources = $availableResources;
            $shipPartResources = $virtualResources - $possibleBuildShips * $shipMass;
            $unfinishedShip->setResourcesUsed($shipPartResources);
        }
        $resultSurface->modifyMaterial(-$usedResources);
        $resultSurface->modifyIndustryUsed($usedResources);
        $resultSurface->modifyPopulationUsed($usedResources);

        return $resultSurface;
    }

    public function getCode(): string
    {
        return self::COMMAND_SHIP;
    }

    public function getModelToBuild(): ShipModel
    {
        return $this->modelToBuild;
    }

    public function setModelToBuild(ShipModel $modelToBuild): ShipCommand
    {
        $this->modelToBuild = $modelToBuild;

        return $this;
    }

    public function getTargetAmount(): int
    {
        return $this->targetAmount;
    }

    public function setTargetAmount(int $targetAmount): ShipCommand
    {
        $this->targetAmount = $targetAmount;

        return $this;
    }

    public function getMadeAmount(): int
    {
        return $this->madeAmount;
    }

}