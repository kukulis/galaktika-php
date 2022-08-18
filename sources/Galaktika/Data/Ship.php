<?php

namespace Galaktika\Data;

class Ship
{
    private string $id;
    private string $name;
    private float $attack;
    private float $defence;
    private float $shields;
    private int $guns = 0;
    private float $cargo;
    private float $engine;
    private float $weight;

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    public function getAttack(): float
    {
        return $this->attack;
    }

    public function setAttack(float $attack): void
    {
        $this->attack = $attack;
    }

    public function getDefence(): float
    {
        return $this->defence;
    }

    public function setDefence(float $defence): void
    {
        $this->defence = $defence;
    }

    public function getShields(): float
    {
        return $this->shields;
    }

    public function setShields(float $shields): void
    {
        $this->shields = $shields;
    }

    public function getGuns(): int
    {
        return $this->guns;
    }

    public function setGuns(int $guns): void
    {
        $this->guns = $guns;
    }

    public function getCargo(): float
    {
        return $this->cargo;
    }

    public function setCargo(float $cargo): void
    {
        $this->cargo = $cargo;
    }

    public function getEngine(): float
    {
        return $this->engine;
    }

    public function setEngine(float $engine): void
    {
        $this->engine = $engine;
    }

    public function getWeight(): float
    {
        return $this->weight;
    }

    public function setWeight(float $weight): void
    {
        $this->weight = $weight;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): Ship
    {
        $this->name = $name;

        return $this;
    }
}

