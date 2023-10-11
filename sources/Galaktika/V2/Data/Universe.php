<?php

namespace Galaktika\V2\Data;

class Universe
{
    private string $id;

    /** @var Planet[]  */
    private array $planets;
    /** @var PlanetSurface[]  */
    private array $planetSurfaces;
    /** @var Race[] */
    private array $races;

    private float $sectorSize;

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId(string $id): void
    {
        $this->id = $id;
    }

    /**
     * @return array
     */
    public function getPlanets(): array
    {
        return $this->planets;
    }

    /**
     * @param array $planets
     */
    public function setPlanets(array $planets): void
    {
        $this->planets = $planets;
    }

    /**
     * @return array
     */
    public function getPlanetSurfaces(): array
    {
        return $this->planetSurfaces;
    }

    /**
     * @param array $planetSurfaces
     */
    public function setPlanetSurfaces(array $planetSurfaces): void
    {
        $this->planetSurfaces = $planetSurfaces;
    }

    /**
     * @return array
     */
    public function getRaces(): array
    {
        return $this->races;
    }

    /**
     * @param array $races
     */
    public function setRaces(array $races): void
    {
        $this->races = $races;
    }

    /**
     * @return float
     */
    public function getSectorSize(): float
    {
        return $this->sectorSize;
    }

    /**
     * @param float $sectorSize
     */
    public function setSectorSize(float $sectorSize): void
    {
        $this->sectorSize = $sectorSize;
    }

    public function calculateSectorX( $x ) : float {
        return floor($x / $this->sectorSize );
    }
    public function calculateSectorY( $y ) : float {
        return floor($y / $this->sectorSize );
    }
}