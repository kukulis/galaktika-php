<?php

namespace Galaktika\V2\Data;

use Galaktika\V2\Production\Project;

class Planet
{
    private string $id;
    private Race $owner;

    private Location $location;
    private float $size;

    private float $population;
    private float $industry;
    private float $material;

    /** @var Project[]  */
    private array $projects;

    /** @var Ship[] */
    private array $ships;



    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): Planet
    {
        $this->id = $id;

        return $this;
    }

    public function getOwner(): Race
    {
        return $this->owner;
    }

    public function setOwner(Race $owner): Planet
    {
        $this->owner = $owner;

        return $this;
    }

    public function getLocation(): Location
    {
        return $this->location;
    }

    public function setLocation(Location $location): Planet
    {
        $this->location = $location;

        return $this;
    }

    public function getPopulation(): float
    {
        return $this->population;
    }

    public function setPopulation(float $population): Planet
    {
        $this->population = $population;

        return $this;
    }

    public function getIndustry(): float
    {
        return $this->industry;
    }

    public function setIndustry(float $industry): Planet
    {
        $this->industry = $industry;

        return $this;
    }

    public function getMaterial(): float
    {
        return $this->material;
    }

    public function setMaterial(float $material): Planet
    {
        $this->material = $material;

        return $this;
    }

    public function getProjects(): array
    {
        return $this->projects;
    }

    public function setProjects(array $projects): Planet
    {
        $this->projects = $projects;

        return $this;
    }

    public function getShips(): array
    {
        return $this->ships;
    }

    public function setShips(array $ships): Planet
    {
        $this->ships = $ships;

        return $this;
    }

    public function getSize(): float
    {
        return $this->size;
    }

    public function setSize(float $size): Planet
    {
        $this->size = $size;

        return $this;
    }

}