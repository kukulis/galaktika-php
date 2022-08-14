<?php

namespace Galaktika\Data\Registry;

use Galaktika\Data\Game;
use Galaktika\Data\Subject;

class SubjectRegistry
{
    private Subject $player;
    private Game $game;

    public function getPlayer(): Subject
    {
        return $this->player;
    }

    public function setPlayer(Subject $player): void
    {
        $this->player = $player;
    }

    public function getGame(): Game
    {
        return $this->game;
    }

    public function setGame(Game $game): void
    {
        $this->game = $game;
    }
}