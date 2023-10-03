<?php

namespace Galaktika\V2\Production;

use Galaktika\V2\Data\Race;

class ShipModel
{
    private string $id;
    private Race $owner;

    private float $mass;
    private float $guns;
    private float $attackMass;
    private float $defenceMass;
    private float $cargoMass;
    private float $engineMass;

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): ShipModel
    {
        $this->id = $id;

        return $this;
    }

    public function getOwner(): Race
    {
        return $this->owner;
    }

    public function setOwner(Race $owner): ShipModel
    {
        $this->owner = $owner;

        return $this;
    }

    public function getMass(): float
    {
        return $this->mass;
    }

    public function setMass(float $mass): ShipModel
    {
        $this->mass = $mass;

        return $this;
    }

    public function getGuns(): float
    {
        return $this->guns;
    }

    public function setGuns(float $guns): ShipModel
    {
        $this->guns = $guns;

        return $this;
    }

    public function getAttackMass(): float
    {
        return $this->attackMass;
    }

    public function setAttackMass(float $attackMass): ShipModel
    {
        $this->attackMass = $attackMass;

        return $this;
    }

    public function getDefenceMass(): float
    {
        return $this->defenceMass;
    }

    public function setDefenceMass(float $defenceMass): ShipModel
    {
        $this->defenceMass = $defenceMass;

        return $this;
    }

    public function getCargoMass(): float
    {
        return $this->cargoMass;
    }

    public function setCargoMass(float $cargoMass): ShipModel
    {
        $this->cargoMass = $cargoMass;

        return $this;
    }

    public function getEngineMass(): float
    {
        return $this->engineMass;
    }

    public function setEngineMass(float $engineMass): ShipModel
    {
        $this->engineMass = $engineMass;

        return $this;
    }
}