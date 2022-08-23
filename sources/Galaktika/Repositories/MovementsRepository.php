<?php

namespace Galaktika\Repositories;

use Galaktika\Data\Movement;

interface MovementsRepository
{
    public function collect(Movement $movement);

    /**
     * @return Movement[]
     */
    public function getMovements(): array;
}