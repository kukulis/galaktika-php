<?php

namespace Galaktika\V2\Data;

class Game
{
    private string $name='';
    private int $turn=0;

    /** @var Race[] */
    private array $players = [];

    /** @var Planet[] */
    private array $planets = [];

    /**
     * @var PlanetSurface[]
     */
    private array $surfaces = [];

    /** @var Fleet[] */
    private array $fleets = [];

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): Game
    {
        $this->name = $name;
        return $this;
    }

    public function getTurn(): int
    {
        return $this->turn;
    }

    public function setTurn(int $turn): Game
    {
        $this->turn = $turn;
        return $this;
    }

    /**
     * @return Race[]
     */
    public function getPlayers(): array
    {
        return $this->players;
    }

    public function setPlayers(array $players): Game
    {
        $this->players = $players;
        return $this;
    }

    /**
     * @return Planet[]
     */
    public function getPlanets(): array
    {
        return $this->planets;
    }

    public function setPlanets(array $planets): Game
    {
        $this->planets = $planets;
        return $this;
    }

    /**
     * @return Fleet[]
     */
    public function getFleets(): array
    {
        return $this->fleets;
    }

    public function setFleets(array $fleets): Game
    {
        $this->fleets = $fleets;
        return $this;
    }

    public function getSurfaces(): array
    {
        return $this->surfaces;
    }

    public function setSurfaces(array $surfaces): Game
    {
        $this->surfaces = $surfaces;
        return $this;
    }
}