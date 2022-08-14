<?php

namespace Galaktika\Data\Registry;

use Galaktika\Data\GameTurn;
use Galaktika\Data\PlanetSurface;

class PlanetSurfaceRegistry
{
    private GameTurn $gameTurn;
    private PlanetSurface $planetSurface;

    public function getGameTurn(): GameTurn
    {
        return $this->gameTurn;
    }

    public function setGameTurn(GameTurn $gameTurn): void
    {
        $this->gameTurn = $gameTurn;
    }

    public function getPlanetSurface(): PlanetSurface
    {
        return $this->planetSurface;
    }

    public function setPlanetSurface(PlanetSurface $planetSurface): void
    {
        $this->planetSurface = $planetSurface;
    }
}