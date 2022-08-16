<?php

namespace Galaktika\Data;

class PlanetSurface
{
    private string $id;

    private Planet $planet;
    private Subject $owner;
    private float $population;
    private float $industry;
    private float $capital;

    public function getPlanet(): Planet
    {
        return $this->planet;
    }

    public function setPlanet(Planet $planet): void
    {
        $this->planet = $planet;
    }

    public function getOwner(): Subject
    {
        return $this->owner;
    }

    public function setOwner(Subject $owner): void
    {
        $this->owner = $owner;
    }

    public function getPopulation(): float
    {
        return $this->population;
    }

    public function setPopulation(float $population): void
    {
        $this->population = $population;
    }

    public function getIndustry(): float
    {
        return $this->industry;
    }

    public function setIndustry(float $industry): void
    {
        $this->industry = $industry;
    }

    public function getCapital(): float
    {
        return $this->capital;
    }

    public function setCapital(float $capital): void
    {
        $this->capital = $capital;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): void
    {
        $this->id = $id;
    }
}