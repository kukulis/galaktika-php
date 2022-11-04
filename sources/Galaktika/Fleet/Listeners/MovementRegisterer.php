<?php

namespace Galaktika\Fleet\Listeners;

use Galaktika\Events\MovementEvent;
use Galaktika\Repositories\MovementsRepository;

class MovementRegisterer
{
    private MovementsRepository $movementsRepository;

    /**
     * @param MovementsRepository $movementsRepository
     */
    public function __construct(MovementsRepository $movementsRepository)
    {
        $this->movementsRepository = $movementsRepository;
    }

    public function call(MovementEvent $movementEvent) {
        $this->movementsRepository->addMovement($movementEvent->getMovement(), $movementEvent->getTurn());
    }
}