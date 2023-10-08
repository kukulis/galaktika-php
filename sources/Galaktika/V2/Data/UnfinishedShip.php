<?php

namespace Galaktika\V2\Data;

class UnfinishedShip
{
    private string $id;
    private Ship $ship;
    private float $materialUsed;

    public function getShip(): Ship
    {
        return $this->ship;
    }

    public function setShip(Ship $ship): UnfinishedShip
    {
        $this->ship = $ship;

        return $this;
    }

    public function getMaterialUsed(): float
    {
        return $this->materialUsed;
    }

    public function setMaterialUsed(float $materialUsed): UnfinishedShip
    {
        $this->materialUsed = $materialUsed;

        return $this;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): UnfinishedShip
    {
        $this->id = $id;

        return $this;
    }

}