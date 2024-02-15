<?php

namespace Galaktika\V2\Data;

class Fleet
{
    private string $bornId;
    private string $id;

    /** @var Ship[] */
    private array $ships = [];

    private ?Location $location = null;

    private ?Location $targetLocation = null;

    /**
     * @var float angle from x axis in radians
     */
    private float $direction = 0;


    public function getShips(): array
    {
        return $this->ships;
    }

    public function setShips(array $ships): Fleet
    {
        $this->ships = $ships;

        return $this;
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

    public function calculateSpeed(): float
    {
        if (count($this->ships) == 0) {
            return 0;
        }
        return min(array_map(fn($ship) => $ship->getSpeed(), $this->ships));
    }

    public function getLocation(): ?Location
    {
        return $this->location;
    }

    public function setLocation(Location $location): Fleet
    {
        $this->location = $location;

        return $this;
    }

    public function getDirection(): float
    {
        return $this->direction;
    }

    public function setDirection(float $direction): Fleet
    {
        $this->direction = $direction;

        return $this;
    }

    public function addShip(Ship $ship): Fleet
    {
        $this->ships[] = $ship;

        return $this;
    }

    /**
     * @return Location|null
     */
    public function getTargetLocation(): ?Location
    {
        return $this->targetLocation;
    }

    /**
     * @param Location|null $targetLocation
     */
    public function setTargetLocation(?Location $targetLocation): void
    {
        $this->targetLocation = $targetLocation;
    }

    public function getBornId(): string
    {
        return $this->bornId;
    }

    public function setBornId(string $bornId): Fleet
    {
        $this->bornId = $bornId;
        return $this;
    }
}