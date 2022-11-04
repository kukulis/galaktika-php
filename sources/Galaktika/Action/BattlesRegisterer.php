<?php

namespace Galaktika\Action;

use Galaktika\Data\GameTurn;
use Galaktika\Repositories\BattlesRepository;
use Galaktika\Repositories\MovementsRepository;
use Galaktika\Repositories\RelationsRepository;

class BattlesRegisterer
{
    private RelationsRepository $relationsRepository;
    private MovementsRepository $movementsRepository;
    private BattlesRepository $battlesRepository;

    /**
     * @param RelationsRepository $relationsRepository
     * @param MovementsRepository $movementsRepository
     * @param BattlesRepository $battlesRepository
     */
    public function __construct(
        RelationsRepository $relationsRepository,
        MovementsRepository $movementsRepository,
        BattlesRepository $battlesRepository
    ) {
        $this->relationsRepository = $relationsRepository;
        $this->movementsRepository = $movementsRepository;
        $this->battlesRepository = $battlesRepository;
    }

    public function registerBattles(GameTurn $gameTurn) {
        // get fleets
        // register movements
        // take movements and register intersections
        // check in-war status (RelationsRepository)
        // take final destinations of movements, check in-war statuses

        // TODO

    }


}