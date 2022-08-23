<?php

namespace Galaktika\Dummy;

use Galaktika\Data\Movement;
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

    /** @var Movement[] */
    private array $movements = [];

    public function collect(Movement $movement)
    {
        $this->movements[$movement->getAxisKey()] = $movement;
    }

    /**
     * @return Movement[]
     */
    public function getMovements(): array
    {
        return $this->movements;
    }
}