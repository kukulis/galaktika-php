<?php

namespace Galaktika\Events;

use Galaktika\Data\Movement;

class MovementEvent
{
    private Movement $movement;

    /**
     * @param Movement $movement
     */
    public function __construct(Movement $movement)
    {
        $this->movement = $movement;
    }

    public function getMovement(): Movement
    {
        return $this->movement;
    }
}