<?php

namespace Galaktika\Dummy;

use Galaktika\Data\GameTurn;
use Galaktika\Data\Movement;
use Galaktika\Data\Registry\MovementRegistry;
use Galaktika\Repositories\MovementFilter;
use Galaktika\Repositories\MovementsRepository;

class DummyMovementRepository implements MovementsRepository
{
    private function __construct()
    {
    }

    private static ?DummyMovementRepository $instance = null;

    public static function getInstance(): DummyMovementRepository
    {
        if (self::$instance == null) {
            self::$instance = new DummyMovementRepository();
        }

        return self::$instance;
    }

    /** @var MovementRegistry[] */
    private array $movementsRegistries = [];

    public function addMovement(Movement $movement, GameTurn $gameTurn)
    {
        $movementRegistry = new MovementRegistry();
        $movementRegistry->setMovement($movement);
        $movementRegistry->setGameTurn($gameTurn);
        $movementRegistry->setAxisKey($movement->getAxisKey());

        $this->movementsRegistries[] = $movementRegistry;
    }

    /**
     * @return Movement[]
     */
    public function getMovements(MovementFilter $movementFilter): array
    {
        return array_map(fn($movementRegistry) => $movementRegistry->getMovement(), $this->movementsRegistries);
    }

}