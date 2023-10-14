<?php

namespace Galaktika\V2\Space;

class Sector
{
    private float $sectorX;
    private float $sectorY;

    private array $objects=[];

    /**
     * @return float
     */
    public function getSectorX(): float
    {
        return $this->sectorX;
    }

    /**
     * @param float $sectorX
     */
    public function setSectorX(float $sectorX): void
    {
        $this->sectorX = $sectorX;
    }

    /**
     * @return float
     */
    public function getSectorY(): float
    {
        return $this->sectorY;
    }

    /**
     * @param float $sectorY
     */
    public function setSectorY(float $sectorY): void
    {
        $this->sectorY = $sectorY;
    }

    /**
     * @return array
     */
    public function getObjects(): array
    {
        return $this->objects;
    }

    /**
     * @param array $objects
     */
    public function setObjects(array $objects): void
    {
        $this->objects = $objects;
    }

    public function addObject($object) : self {
        $this->objects[] = $object;

        return $this;
    }
}