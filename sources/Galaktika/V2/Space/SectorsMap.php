<?php

namespace Galaktika\V2\Space;

use InvalidArgumentException;
use OutOfBoundsException;

class SectorsMap
{
    /** @var Sector[] */
    private array $sectors;

    private float $universeSize;
    private float $sectorSize;

    private int $n;

    public function __construct($universeSize, $sectorSize)
    {
        $this->universeSize = $universeSize;
        $this->sectorSize = $sectorSize;
        $this->n = $universeSize / $sectorSize;

        $this->sectors = self::buildSectors($universeSize, $sectorSize);
    }

    public function getSectorByCoordinates(float $x, float $y): Sector
    {
        // may be rebound instead?
        $this->validateBounds($x);
        $this->validateBounds($y);

        $sectorX = $this->getSectorIndex($x);
        $sectorY = $this->getSectorIndex($y);

        return $this->getSector($sectorX, $sectorY);
    }

    public function addObject(float $x, float $y, $object): self
    {
        $this->getSectorByCoordinates($x, $y)->addObject($object);

        return $this;
    }

    public static function buildSectors(float $universeSize, float $sectorSize): array
    {
        $sectorCountD1 = intval($universeSize / $sectorSize);

        if ($sectorCountD1 * $sectorSize < $universeSize) {
            throw new InvalidArgumentException(
                sprintf(
                    'Sector size %s must be repeated to whole universe size %s. Now we have remaining %s gap.',
                    $sectorSize,
                    $universeSize,
                    $universeSize - $sectorCountD1 * $sectorSize
                )
            );
        }

        $sectors = [];
        for ($x = 0; $x < $sectorCountD1; $x++) {
            for ($y = 0; $y < $sectorCountD1; $y++) {
                $sector = new Sector();
                $sector->setSectorX($x * $sectorSize);
                $sector->setSectory($y * $sectorSize);

                $sectors[] = $sector;
            }
        }

        return $sectors;
    }


    /**
     * @return SectorIndex[]
     */
    public function getNearbyCoordinates(float $i, float $j, int $sectorRadius = 0): array
    {
        $indexes = [];
        for ($ii = $i - $sectorRadius; $ii <= $i + $sectorRadius; $ii++) {
            for ($jj = $j - $sectorRadius; $jj <= $j + $sectorRadius; $jj++) {
                $indexes[] = new SectorIndex($this->reboundIndex($ii), $this->reboundIndex($jj));
            }
        }

        return $indexes;
    }

    public function getNearbyObjects(float $x, float $y, int $sectorRadius = 0): array
    {
        $i = $this->getSectorIndex($x);
        $j = $this->getSectorIndex($y);

        $coordinates = $this->getNearbyCoordinates($i, $j, $sectorRadius);

        $allObjects = [];
        foreach ($coordinates as $coordinate) {
            $allObjects = array_merge(
                $allObjects,
                $this->getSector($coordinate->getI(), $coordinate->getJ())->getObjects()
            );
        }

        return $allObjects;
    }

    public function getSectorIndex(float $coordinate): int
    {
        return intval($coordinate / $this->sectorSize);
    }

    public function getSector(int $i, int $j): Sector
    {
        $this->validateIndexBounds($i);
        $this->validateIndexBounds($j);

        $index = $i * $this->n + $j;

        return $this->sectors[$index];
    }

    public function validateBounds(float $coordinate)
    {
        if ($coordinate < 0 || $coordinate >= $this->universeSize) {
            throw new OutOfBoundsException('Coordinate %s is out of universe', $coordinate);
        }
    }

    public function validateIndexBounds(int $index)
    {
        if ($index < 0 || $index >= $this->n) {
            throw  new OutOfBoundsException(sprintf('Index %i is out of bounds', $index));
        }
    }


    /**
     * Making universe a thor.
     *
     * TODO cover with unit test.
     */
    public function rebound(float $coordinate): float
    {
        if ($coordinate >= 0 && $coordinate < $this->universeSize) {
            return $coordinate;
        }

        if ($coordinate < 0) {
            $multiplier = intval(abs($coordinate) / $this->universeSize) + 1;

            return $coordinate + $multiplier * $this->universeSize;
        }

//         $coordinate >= $this->universeSize
        $multiplier = intval($coordinate / $this->universeSize);

        return $coordinate - $multiplier * $this->universeSize;
    }

    public function reboundIndex(int $index): int
    {
        if ($index >= 0 && $index < $this->n) {
            return $index;
        }

        if ($index < 0) {
            $multiplier = intval(abs($index) / $this->n) + 1;

            return $index + $this->n * $multiplier;
        }

        return $index % $this->n;
    }

    public function getAllObjects() : array {
        $rez = [];
        foreach ($this->sectors as $s) {
            $rez = array_merge($rez, $s->getObjects());
        }
        return $rez;
    }
}