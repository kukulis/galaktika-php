<?php

namespace Galaktika\Data;

class ShipProject
{
    private int $guns = 0;
    private float $gunMass = 0;
    private float $shieldMass = 0;
    private float $engineMass = 0;
    private float $cargoMass = 0;

    public function getGuns(): int
    {
        return $this->guns;
    }

    public function setGuns(int $guns): void
    {
        $this->guns = $guns;
    }

    public function getGunMass(): float
    {
        return $this->gunMass;
    }

    public function setGunMass(float $gunMass): void
    {
        $this->gunMass = $gunMass;
    }

    public function getShieldMass(): float
    {
        return $this->shieldMass;
    }

    public function setShieldMass(float $shieldMass): void
    {
        $this->shieldMass = $shieldMass;
    }

    public function getEngineMass(): float
    {
        return $this->engineMass;
    }

    public function setEngineMass(float $engineMass): void
    {
        $this->engineMass = $engineMass;
    }

    public function getCargoMass(): float
    {
        return $this->cargoMass;
    }

    public function setCargoMass(float $cargoMass): void
    {
        $this->cargoMass = $cargoMass;
    }


}