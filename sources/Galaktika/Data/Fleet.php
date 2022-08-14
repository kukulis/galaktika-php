<?php

namespace Galaktika\Data;

class Fleet
{
    /**
     * @var ShipGroup[]
     */
    private array $shipGroups;

    public function getShipGroups(): array
    {
        return $this->shipGroups;
    }

    public function setShipGroups(array $shipGroups): void
    {
        $this->shipGroups = $shipGroups;
    }

}