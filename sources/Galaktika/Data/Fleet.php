<?php

namespace Galaktika\Data;

class Fleet
{
    /**
     * @var ShipGroup[]
     */
    private array $shipGroups = [];

    private Location $currentLocation;
    private Location $destinationLocation;

    private string $id;

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

    public function getMinimalSpeed(): float
    {
        $speeds = array_map(fn(ShipGroup $shipGroup) => $shipGroup->getSpeed(), $this->shipGroups);

        return min($speeds);
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): Fleet
    {
        $this->id = $id;

        return $this;
    }

    public function addGroup(ShipGroup $shipGroup): self
    {
        $this->shipGroups[] = $shipGroup;

        return $this;
    }


    public static function buildWithLocation(Location $location): Fleet {
        $fleet = new Fleet();
        $fleet->setCurrentLocation($location);

        return $fleet;
    }

    public function getOwner(): ?Subject {
        if (  count($this->shipGroups) == 0 ) {
            return null;
        }

        return $this->shipGroups[0]->getOwner();
    }
}