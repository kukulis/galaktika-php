<?php

namespace Galaktika\V2\Data;

class PlanetSurface
{
    private string $id;
    private Planet $planet;
    private Race $owner;
    private float $population;
    private float $industry;
    private float $material;

    private $usedPopulation = 0;
    private $usedIndustry = 0;

    /** @var UnfinishedShip[] */
    private array $unfinishedShips = [];

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

    public function removeUnfinishedShip(UnfinishedShip $unfinishedShip)
    {
        unset($this->unfinishedShips[$unfinishedShip->getId()]);
    }

    public function getUsedPopulation(): int
    {
        return $this->usedPopulation;
    }

    public function setUsedPopulation(int $usedPopulation): PlanetSurface
    {
        $this->usedPopulation = $usedPopulation;

        return $this;
    }

    public function getUsedIndustry(): int
    {
        return $this->usedIndustry;
    }

    public function setUsedIndustry(int $usedIndustry): PlanetSurface
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

}