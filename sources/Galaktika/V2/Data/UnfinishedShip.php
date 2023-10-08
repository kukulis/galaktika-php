<?php

namespace Galaktika\V2\Data;

class UnfinishedShip
{
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


}