<?php

namespace Galaktika\V2\Data;

class Ship
{
    private string $id;
    private int $guns=0;
    private float $attack=0;
    private float $defence=0;
    private float $speed=0;
    private float $mass=0;
    private float $maxCargo=0;
    private ?Race $owner=null;

    private string $modelName;
    private string $modelId;

    private float $x;
    private float $y;

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

    public function getOwner(): Race
    {
        return $this->owner;
    }

    public function setOwner(Race $owner): Ship
    {
        $this->owner = $owner;

        return $this;
    }

    public function getModelName(): string
    {
        return $this->modelName;
    }

    public function setModelName(string $modelName): Ship
    {
        $this->modelName = $modelName;

        return $this;
    }

    public function getModelId(): string
    {
        return $this->modelId;
    }

    public function setModelId(string $modelId): Ship
    {
        $this->modelId = $modelId;

        return $this;
    }

    /**
     * @return float
     */
    public function getX(): float
    {
        return $this->x;
    }

    /**
     * @param float $x
     */
    public function setX(float $x): void
    {
        $this->x = $x;
    }

    /**
     * @return float
     */
    public function getY(): float
    {
        return $this->y;
    }

    /**
     * @param float $y
     */
    public function setY(float $y): void
    {
        $this->y = $y;
    }
}