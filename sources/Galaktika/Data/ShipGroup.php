<?php

namespace Galaktika\Data;

class ShipGroup
{
    private string $id;
    private Ship $ship;
    private int $amount;

    public function getShip(): Ship
    {
        return $this->ship;
    }

    public function setShip(Ship $ship): void
    {
        $this->ship = $ship;
    }

    public function getAmount(): int
    {
        return $this->amount;
    }

    public function setAmount(int $amount): void
    {
        $this->amount = $amount;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): ShipGroup
    {
        $this->id = $id;

        return $this;
    }

}