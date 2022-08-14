<?php

namespace Galaktika\Data;

class Technologies
{
    private float $attack = 1;
    private float $defence = 1;
    private float $engine = 1;
    private float $cargo = 1;

    public function getAttack(): float|int
    {
        return $this->attack;
    }

    public function setAttack(float|int $attack): void
    {
        $this->attack = $attack;
    }

    public function getDefence(): float|int
    {
        return $this->defence;
    }

    public function setDefence(float|int $defence): void
    {
        $this->defence = $defence;
    }

    public function getEngine(): float|int
    {
        return $this->engine;
    }

    public function setEngine(float|int $engine): void
    {
        $this->engine = $engine;
    }

    public function getCargo(): float|int
    {
        return $this->cargo;
    }

    public function setCargo(float|int $cargo): void
    {
        $this->cargo = $cargo;
    }


}