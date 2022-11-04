<?php

namespace Galaktika\Repositories;

use Galaktika\Data\GameTurn;
use Galaktika\Data\Movement;
use Galaktika\Data\Registry\MovementRegistry;

interface MovementsRepository
{
    public function addMovement(Movement $movement, GameTurn $gameTurn);

    /**
     * @return MovementRegistry[]
     */
    public function getMovements(MovementFilter $movementFilter): array;

}