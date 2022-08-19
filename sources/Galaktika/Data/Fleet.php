<?php

namespace Galaktika\Data;

class Fleet
{
    /**
     * @var ShipGroup[]
     */
    private array $shipGroups;

    private Location $currentLocation;
    private Location $destinationLocation;

    public function getShipGroups(): array
    {
        return $this->shipGroups;
    }

    public function setShipGroups(array $shipGroups): void
    {
        $this->shipGroups = $shipGroups;
    }

    public function getCurrentLocation(): Location
    {
        return $this->currentLocation;
    }

    public function setCurrentLocation(Location $currentLocation): Fleet
    {
        $this->currentLocation = $currentLocation;

        return $this;
    }

    public function getDestinationLocation(): Location
    {
        return $this->destinationLocation;
    }

    public function setDestinationLocation(Location $destinationLocation): Fleet
    {
        $this->destinationLocation = $destinationLocation;

        return $this;
    }

    public function getMinimalSpeed() : float {
        $speeds = array_map( fn(ShipGroup $shipGroup) => $shipGroup->getSpeed(), $this->shipGroups);

        return min($speeds);
    }

}