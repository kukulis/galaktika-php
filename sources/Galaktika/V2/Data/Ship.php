<?php

namespace Galaktika\V2\Data;

class Ship
{
    private string $id;
    private int $guns;
    private float $attack;
    private float $defence;
    private float $speed;
    private float $mass;
    private float $maxCargo;
    private float $load;
    private Race $owner;

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): Ship
    {
        $this->id = $id;

        return $this;
    }

    public function getGuns(): int
    {
        return $this->guns;
    }

    public function setGuns(int $guns): Ship
    {
        $this->guns = $guns;

        return $this;
    }

    public function getAttack(): float
    {
        return $this->attack;
    }

    public function setAttack(float $attack): Ship
    {
        $this->attack = $attack;

        return $this;
    }

    public function getDefence(): float
    {
        return $this->defence;
    }

    public function setDefence(float $defence): Ship
    {
        $this->defence = $defence;

        return $this;
    }

    public function getSpeed(): float
    {
        return $this->speed;
    }

    public function setSpeed(float $speed): Ship
    {
        $this->speed = $speed;

        return $this;
    }

    public function getMass(): float
    {
        return $this->mass;
    }

    public function setMass(float $mass): Ship
    {
        $this->mass = $mass;

        return $this;
    }

    public function getMaxCargo(): float
    {
        return $this->maxCargo;
    }

    public function setMaxCargo(float $maxCargo): Ship
    {
        $this->maxCargo = $maxCargo;

        return $this;
    }

    public function getLoad(): float
    {
        return $this->load;
    }

    public function setLoad(float $load): Ship
    {
        $this->load = $load;

        return $this;
    }

    public function getOwner(): Race
    {
        return $this->owner;
    }

    public function setOwner(Race $owner): Ship
    {
        $this->owner = $owner;

        return $this;
    }

}