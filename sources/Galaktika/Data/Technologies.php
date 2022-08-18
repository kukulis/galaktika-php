<?php

namespace Galaktika\Data;

class Technologies
{
    private float $attack = 1.0;
    private float $defence = 1.0;
    private float $engine = 1.0;
    private float $cargo = 1.0;

    public function getAttack(): float
    {
        return $this->attack;
    }

    public function setAttack(float $attack): Technologies
    {
        $this->attack = $attack;

        return $this;
    }

    public function getDefence(): float
    {
        return $this->defence;
    }

    public function setDefence(float $defence): Technologies
    {
        $this->defence = $defence;

        return $this;
    }

    public function getEngine(): float
    {
        return $this->engine;
    }

    public function setEngine(float $engine): Technologies
    {
        $this->engine = $engine;

        return $this;
    }

    public function getCargo(): float
    {
        return $this->cargo;
    }

    public function setCargo(float $cargo): Technologies
    {
        $this->cargo = $cargo;

        return $this;
    }
}