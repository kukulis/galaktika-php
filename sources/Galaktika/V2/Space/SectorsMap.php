<?php

namespace Galaktika\V2\Space;

class SectorsMap
{
    /** @var Sector[]  */
    private array $sectors;

    private float $sectorSize;

    private int $n;

    /**
     * @param Sector[] $sectors
     */
    public function __construct(array $sectors, float $sectorSize, int $n)
    {
        // TODO build sectors here
        $this->sectors = $sectors;
        $this->sectorSize = $sectorSize;
        $this->n = $n;
    }

    public function getSectorByCoordinates(float $x, float $y) : Sector {
        $sectorX = floor ( $x / $this->sectorSize);
        $sectorY = floor ( $y / $this->sectorSize);

        $i = $sectorX * $this->n + $sectorY;

        return $this->sectors[$i];
    }

    public function addObject( float $x, float $y,  $object) : self {
        $this->getSectorByCoordinates($x,$y)->addObject($object);

        return $this;
    }
}