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

    private float $size;

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
    public function getSize(): float
    {
        return $this->size;
    }

    /**
     * @param float $size
     */
    public function setSize(float $size): void
    {
        $this->size = $size;
    }
}