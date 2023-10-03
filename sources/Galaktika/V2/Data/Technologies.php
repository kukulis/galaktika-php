<?php

namespace Galaktika\V2\Data;

class Technologies
{
    private float $engines;
    private float $defence;
    private float $attack;
    private float $cargo;

    public function getEngines(): float
    {
        return $this->engines;
    }

    public function setEngines(float $engines): Technologies
    {
        $this->engines = $engines;

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

    public function getAttack(): float
    {
        return $this->attack;
    }

    public function setAttack(float $attack): Technologies
    {
        $this->attack = $attack;

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