<?php

namespace Galaktika\V2\Production;

use Galaktika\IdGenerator;
use Galaktika\V2\Data\PlanetSurface;
use Galaktika\V2\Data\UnfinishedShip;

class ShipCommand implements PlanetSurfaceCommand
{
    private ShipModel $modelToBuild;
    private int $targetAmount;

    private int $madeAmount = 0;
    private IdGenerator $idGenerator;

    public function execute(PlanetSurface $planetSurface, PlanetSurface $oldSurface): void
    {
        $unfinishedShip = $planetSurface->findUnfinishedShipByModelId($this->modelToBuild->getId());
        $shipMass = $this->modelToBuild->getMass();

        $unfinishedResources = 0;
        if ($unfinishedShip != null) {
            $unfinishedResources = $unfinishedShip->getResourcesUsed();
        }

        $availableResources = min(
            $oldSurface->getMaterial(),
            $oldSurface->getUnusedIndustry(),
            $oldSurface->getUnusedPopulation()
        );

        $virtualResources = $unfinishedResources + $availableResources;
        $possibleBuildShips = intval($virtualResources / $shipMass);
        $this->madeAmount = min($possibleBuildShips, $this->targetAmount);

        $ship = ShipCalculator2::calculate($this->modelToBuild, $oldSurface->getOwner()->getTechnologies());

        if ($possibleBuildShips >= $this->targetAmount) {
            $usedResources = $shipMass * $this->targetAmount - $unfinishedResources;
            $planetSurface->removeUnfinishedShip($unfinishedShip);
        } else {
            $usedResources = $availableResources;
            $shipPartResources = $virtualResources - $possibleBuildShips * $shipMass;

            // create new unfinished ship
            $unfinishedShip = new UnfinishedShip();
            $unfinishedShip->setShip($ship);
            $unfinishedShip->setResourcesUsed($shipPartResources);

            $planetSurface->removeUnfinishedShipByModelId($this->modelToBuild->getId());
            $planetSurface->addUnfinishedShip($unfinishedShip);
        }
        $planetSurface->modifyMaterial(-$usedResources);
        $planetSurface->modifyIndustryUsed($usedResources);
        $planetSurface->modifyPopulationUsed($usedResources);

        if ($this->madeAmount > 0) {
            for ($i = 0; $i < $this->madeAmount; $i++) {
                $newShip = clone $ship;
                $newShip->setId($this->idGenerator->generateId());
                $planetSurface->addShip($newShip);
            }
        }
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

    public function setIdGenerator(IdGenerator $idGenerator): ShipCommand
    {
        $this->idGenerator = $idGenerator;
        return $this;
    }
}