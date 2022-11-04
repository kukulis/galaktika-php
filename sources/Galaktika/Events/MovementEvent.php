<?php

namespace Galaktika\Events;

use Galaktika\Data\GameTurn;
use Galaktika\Data\Movement;

class MovementEvent
{
    private Movement $movement;
    private GameTurn $turn;

    /**
     * @param Movement $movement
     * @param GameTurn $turn
     */
    public function __construct(Movement $movement, GameTurn $turn)
    {
        $this->movement = $movement;
        $this->turn = $turn;
    }


    public function getMovement(): Movement
    {
        return $this->movement;
    }

    public function getTurn(): GameTurn
    {
        return $this->turn;
    }
}