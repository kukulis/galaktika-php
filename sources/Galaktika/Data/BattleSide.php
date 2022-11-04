<?php

namespace Galaktika\Data;

class BattleSide
{
    /**
     * @var ShipGroup[]
     */
    private array $shipGroups;

    public function getShipGroups(): array
    {
        return $this->shipGroups;
    }

    public function setShipGroups(array $shipGroups): BattleSide
    {
        $this->shipGroups = $shipGroups;

        return $this;
    }
}