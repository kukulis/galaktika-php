<?php

namespace Galaktika\V2\Data;

use Galaktika\V2\Production\Project;

class PlanetSurface
{
    private string $id;
    private Planet $planet;
    private Race $owner;
    private float $population;
    private float $industry;
    private float $material;

    private array $unfinishedShips=[];

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

    public function removeUnfinishedShip( UnfinishedShip $unfinishedShip) {
        unset($this->unfinishedShips[$unfinishedShip->getId()]);
    }
}