<?php

namespace Galaktika\V2\Data;

use Galaktika\V2\Production\IndustryCommand;
use Galaktika\V2\Production\PlanetSurfaceCommand;

class PlanetSurface
{
    private string $id;
    private Planet $planet;
    private Race $owner;
    private float $population;
    private float $industry;
    private float $material;

    private float $usedPopulation = 0;
    private float $usedIndustry = 0;

    /** @var UnfinishedShip[] */
    private array $unfinishedShips = [];

    /** @var Ship[] */
    private array $ships;

    /** @var PlanetSurfaceCommand[]  */
    private array $commands=[];

    public function removeUnfinishedShip(?UnfinishedShip $unfinishedShip): self
    {
        if ($unfinishedShip == null) {
            return $this;
        }

        $this->unfinishedShips = array_filter(
            $this->unfinishedShips,
            fn(UnfinishedShip $sh) => $sh->getId() != $unfinishedShip->getId()
        );

        return $this;
    }

    public function removeUnfinishedShipByModelId($modelId): self
    {
        $this->unfinishedShips = array_filter(
            $this->unfinishedShips,
            fn(UnfinishedShip $sh) => $sh->getShip()->getModelId() != $modelId
        );

        return $this;
    }


    // ==========================================================
    // setters and getters
    // ==========================================================

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): PlanetSurface
    {
        $this->id = $id;

        return $this;
    }

    public function getPlanet(): Planet
    {
        return $this->planet;
    }

    public function setPlanet(Planet $planet): PlanetSurface
    {
        $this->planet = $planet;

        return $this;
    }

    public function getOwner(): Race
    {
        return $this->owner;
    }

    public function setOwner(Race $owner): PlanetSurface
    {
        $this->owner = $owner;

        return $this;
    }

    public function getPopulation(): float
    {
        return $this->population;
    }

    public function setPopulation(float $population): PlanetSurface
    {
        $this->population = $population;

        return $this;
    }

    public function getIndustry(): float
    {
        return $this->industry;
    }

    public function setIndustry(float $industry): PlanetSurface
    {
        $this->industry = $industry;

        return $this;
    }

    public function getMaterial(): float
    {
        return $this->material;
    }

    public function setMaterial(float $material): PlanetSurface
    {
        $this->material = $material;

        return $this;
    }

    public function getUsedPopulation(): float
    {
        return $this->usedPopulation;
    }

    public function setUsedPopulation(float $usedPopulation): PlanetSurface
    {
        $this->usedPopulation = $usedPopulation;

        return $this;
    }

    public function getUsedIndustry(): float
    {
        return $this->usedIndustry;
    }

    public function setUsedIndustry(float $usedIndustry): PlanetSurface
    {
        $this->usedIndustry = $usedIndustry;

        return $this;
    }

    public function getUnfinishedShips(): array
    {
        return $this->unfinishedShips;
    }

    public function setUnfinishedShips(array $unfinishedShips): PlanetSurface
    {
        $this->unfinishedShips = $unfinishedShips;

        return $this;
    }

    public function getUnusedIndustry(): float
    {
        return $this->industry - $this->usedIndustry;
    }

    public function getUnusedPopulation(): float
    {
        return $this->population - $this->usedPopulation;
    }

    public function findUnfinishedShipByModelId(string $modelId): ?UnfinishedShip
    {
        foreach ($this->getUnfinishedShips() as $unfinishedShip) {
            if ($unfinishedShip->getShip()->getModelId() == $modelId) {
                return $unfinishedShip;
            }
        }

        return null;
    }

    public function getShips(): array
    {
        return $this->ships;
    }

    public function setShips(array $ships): PlanetSurface
    {
        $this->ships = $ships;

        return $this;
    }

    public function addShip(Ship $ship)
    {
        $this->ships[] = $ship;
    }

    public function modifyMaterial(float $change)
    {
        $this->material += $change;
    }

    public function modifyIndustryUsed(float $change)
    {
        $this->usedIndustry += $change;
    }

    public function modifyPopulationUsed(float $change)
    {
        $this->usedPopulation += $change;
    }

    public function addUnfinishedShip(UnfinishedShip $unfinishedShip): self
    {
        $this->unfinishedShips[] = $unfinishedShip;

        return $this;
    }

    public function getCommands(): array
    {
        return $this->commands;
    }

    public function setCommands(array $commands): PlanetSurface
    {
        $this->commands = $commands;
        return $this;
    }

}