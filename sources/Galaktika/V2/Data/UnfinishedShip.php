<?php

namespace Galaktika\V2\Data;

class UnfinishedShip
{
    private string $id;
    private Ship $ship;
    private float $resourcesUsed;

    public function getShip(): Ship
    {
        return $this->ship;
    }

    public function setShip(Ship $ship): UnfinishedShip
    {
        $this->ship = $ship;

        return $this;
    }

    public function getResourcesUsed(): float
    {
        return $this->resourcesUsed;
    }

    public function setResourcesUsed(float $resourcesUsed): UnfinishedShip
    {
        $this->resourcesUsed = $resourcesUsed;

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