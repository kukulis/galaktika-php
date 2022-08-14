<?php

namespace Galaktika\Data;

class GameTurn
{
    private Game $game;
    private int $turn;

    public function getGame(): Game
    {
        return $this->game;
    }

    public function setGame(Game $game): void
    {
        $this->game = $game;
    }

    public function getTurn(): int
    {
        return $this->turn;
    }

    public function setTurn(int $turn): void
    {
        $this->turn = $turn;
    }


}