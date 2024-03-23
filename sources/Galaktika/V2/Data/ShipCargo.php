<?php

namespace Galaktika\V2\Data;

class ShipCargo
{
    private string $id;
    private Ship $ship;
    private float $population=0;
    private float $material=0;

    public function getShip(): Ship
    {
        return $this->ship;
    }

    public function getPopulation(): float
    {
        return $this->population;
    }

    public function setPopulation(float $population): ShipCargo
    {
        $this->population = $population;
        return $this;
    }

    public function getMaterial(): float
    {
        return $this->material;
    }

    public function setMaterial(float $material): ShipCargo
    {
        $this->material = $material;
        return $this;
    }

    public function getFreeSpace(): float  {
        return $this->ship->getMaxCargo() - $this->getPopulation() - $this->getMaterial();
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): ShipCargo
    {
        $this->id = $id;
        return $this;
    }

    public function setShip(Ship $ship): ShipCargo
    {
        $this->ship = $ship;
        return $this;
    }
}