<?php

namespace Galaktika\Data;

class PlanetSurface
{
    private string $id;
    private Planet $planet;
    private Subject $owner;
    private float $population = 0;
    private float $industry = 0;
    private float $capital = 0;
    private float $producedShipPart = 0;
    private ?ShipProject $shipProject;

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

    public function getOwner(): Subject
    {
        return $this->owner;
    }

    public function setOwner(Subject $owner): PlanetSurface
    {
        $this->owner = $owner;

        return $this;
    }

    public function getPopulation()
    {
        return $this->population;
    }

    public function setPopulation($population)
    {
        $this->population = $population;

        return $this;
    }

    public function getIndustry()
    {
        return $this->industry;
    }

    public function setIndustry($industry)
    {
        $this->industry = $industry;

        return $this;
    }

    public function getCapital()
    {
        return $this->capital;
    }

    public function setCapital($capital)
    {
        $this->capital = $capital;

        return $this;
    }

    public function getProducedShipPart()
    {
        return $this->producedShipPart;
    }

    public function setProducedShipPart($producedShipPart)
    {
        $this->producedShipPart = $producedShipPart;

        return $this;
    }

    public function getShipProject(): ?ShipProject
    {
        return $this->shipProject;
    }

    public function setShipProject(?ShipProject $shipProject): PlanetSurface
    {
        $this->shipProject = $shipProject;

        return $this;
    }
}