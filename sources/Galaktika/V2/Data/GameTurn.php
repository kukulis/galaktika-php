<?php

namespace Galaktika\V2\Data;

/**
 * By the current usage this is not a game, this is GameTurn.
 */
class GameTurn
{
    private string $name = '';
    private int $turn = 0;

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

    /**
     * @var ShipCargo[]
     */
    private array $shipCargos = [];

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): GameTurn
    {
        $this->name = $name;
        return $this;
    }

    public function getTurn(): int
    {
        return $this->turn;
    }

    public function setTurn(int $turn): GameTurn
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

    public function setPlayers(array $players): GameTurn
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

    public function setPlanets(array $planets): GameTurn
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

    public function setFleets(array $fleets): GameTurn
    {
        $this->fleets = $fleets;
        return $this;
    }

    public function getSurfaces(): array
    {
        return $this->surfaces;
    }

    public function setSurfaces(array $surfaces): GameTurn
    {
        $this->surfaces = $surfaces;
        return $this;
    }

    public function getShipCargos(): array
    {
        return $this->shipCargos;
    }

    public function setShipCargos(array $shipCargos): GameTurn
    {
        $this->shipCargos = $shipCargos;
        return $this;
    }
}