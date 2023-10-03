<?php

namespace Galaktika\V2\Production;

class Project
{
    private string $id;
    private bool $active;
    private int $priority;
    private int $maxLimit;
    private float $donePart;

    private ShipModel $shipModel;

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): Project
    {
        $this->id = $id;

        return $this;
    }

    public function isActive(): bool
    {
        return $this->active;
    }

    public function setActive(bool $active): Project
    {
        $this->active = $active;

        return $this;
    }

    public function getPriority(): int
    {
        return $this->priority;
    }

    public function setPriority(int $priority): Project
    {
        $this->priority = $priority;

        return $this;
    }

    public function getDonePart(): float
    {
        return $this->donePart;
    }

    public function setDonePart(float $donePart): Project
    {
        $this->donePart = $donePart;

        return $this;
    }

    public function getShipModel(): ShipModel
    {
        return $this->shipModel;
    }

    public function setShipModel(ShipModel $shipModel): Project
    {
        $this->shipModel = $shipModel;

        return $this;
    }

    public function getMaxLimit(): int
    {
        return $this->maxLimit;
    }

    public function setMaxLimit(int $maxLimit): Project
    {
        $this->maxLimit = $maxLimit;

        return $this;
    }
 }