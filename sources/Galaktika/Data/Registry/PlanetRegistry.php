<?php

namespace Galaktika\Data\Registry;

use Galaktika\Data\Game;
use Galaktika\Data\Planet;

class PlanetRegistry
{
    private Game $game;
    private Planet $planet;

    public function getGame(): Game
    {
        return $this->game;
    }

    public function setGame(Game $game): void
    {
        $this->game = $game;
    }

    public function getPlanet(): Planet
    {
        return $this->planet;
    }

    public function setPlanet(Planet $planet): void
    {
        $this->planet = $planet;
    }
}