<?php

namespace Galaktika\Data\Registry;

use Galaktika\Data\GameTurn;
use Galaktika\Data\Movement;

class MovementRegistry
{
    private Movement $movement;
    private GameTurn $gameTurn;
    private string $axisKey;

    public function getMovement(): Movement
    {
        return $this->movement;
    }

    public function setMovement(Movement $movement): MovementRegistry
    {
        $this->movement = $movement;

        return $this;
    }

    public function getGameTurn(): GameTurn
    {
        return $this->gameTurn;
    }

    public function setGameTurn(GameTurn $gameTurn): MovementRegistry
    {
        $this->gameTurn = $gameTurn;

        return $this;
    }

    public function getAxisKey(): string
    {
        return $this->axisKey;
    }

    public function setAxisKey(string $axisKey): MovementRegistry
    {
        $this->axisKey = $axisKey;

        return $this;
    }

}