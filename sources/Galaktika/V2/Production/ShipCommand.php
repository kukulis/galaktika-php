<?php

namespace Galaktika\V2\Production;

use Galaktika\V2\Data\PlanetSurface;

class ShipCommand implements PlanetSurfaceCommand
{
    private ShipModel $modelToBuild;
    private int $targetAmount;

    public function execute(PlanetSurface $planetSurface): PlanetSurface
    {
        $resultSurface = clone $planetSurface;
        $unfinishedShip = $resultSurface->findUnfinishedShipByModelId($this->modelToBuild->getId());
        $shipMass = $this->modelToBuild->getMass();


        if ($unfinishedShip != null) {
            $resourcesToUse = min(
                $shipMass - $unfinishedShip->getMaterialUsed(),
                $resultSurface->getMaterial(),
                $resultSurface->getUnusedPopulation(),
                $resultSurface->getUnusedIndustry()
            );

            $resultSurface->modifyMaterial(-$resourcesToUse);
            $resultSurface->modifyPopulationUsed(-$resourcesToUse);
            $resultSurface->modifyIndustryUsed(-$resourcesToUse);


            if ($resourcesToUse >= $shipMass - $unfinishedShip->getMaterialUsed()) {
                // ship built
                $plannedShip = ShipCalculator2::calculate(
                    $this->modelToBuild,
                    $planetSurface->getOwner()->getTechnologies()
                );
                $planetSurface->addShip($plannedShip);
                $planetSurface->removeUnfinishedShip($unfinishedShip);
                $this->targetAmount --;
            } else {
                // still unfinished
                $unfinishedShip->setMaterialUsed($resourcesToUse + $unfinishedShip->getMaterialUsed());
            }
        }

        // TODO calculate many ships in one formula TODO





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

}