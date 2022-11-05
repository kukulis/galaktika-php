<?php

namespace Galaktika\Data;

class ShipGroup
{
    private string $id;
    private Ship $ship;
    private int $amount;
    private Subject $owner;

    /** @var float cargo for a single ship */
    private float $cargoPopulation = 0.0;
    /** @var float cargo for a single ship */
    private float $cargoCapital = 0.0;

    public function getShip(): Ship
    {
        return $this->ship;
    }

    public function setShip(Ship $ship): void
    {
        $this->ship = $ship;
    }

    public function getAmount(): int
    {
        return $this->amount;
    }

    public function setAmount(int $amount): void
    {
        $this->amount = $amount;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): ShipGroup
    {
        $this->id = $id;

        return $this;
    }

    public function getCargoPopulation(): float
    {
        return $this->cargoPopulation;
    }

    public function setCargoPopulation(float $cargoPopulation): ShipGroup
    {
        $this->cargoPopulation = $cargoPopulation;

        return $this;
    }

    public function getCargoCapital(): float
    {
        return $this->cargoCapital;
    }

    public function setCargoCapital(float $cargoCapital): ShipGroup
    {
        $this->cargoCapital = $cargoCapital;

        return $this;
    }

    public function getOneShipWeight(): float
    {
        return $this->ship->getWeight() + $this->cargoCapital + $this->cargoPopulation;
    }

    public function getSpeed(): float
    {
        return $this->ship->getEngine() / $this->getOneShipWeight();
    }

    public function getOwner(): Subject
    {
        return $this->owner;
    }

    public function setOwner(Subject $owner): ShipGroup
    {
        $this->owner = $owner;

        return $this;
    }

    public static function build(Ship $ship, int $amount, Subject $owner): ShipGroup
    {
        $shipGroup = new ShipGroup();
        $shipGroup->setShip($ship);
        $shipGroup->setAmount($amount);
        $shipGroup->setOwner($owner);

        return $shipGroup;
    }

}