<?php

namespace Galaktika\Dummy;

use Galaktika\Data\Battle;
use Galaktika\Data\GameTurn;
use Galaktika\Data\Movement;
use Galaktika\Data\Registry\BattleRegistry;
use Galaktika\Repositories\BattlesFilter;
use Galaktika\Repositories\BattlesRepository;
use Galaktika\Repositories\MovementFilter;

class DummyBattlesRepository implements BattlesRepository
{
    /**
     * @var BattleRegistry[]
     */
    private array $battleRegistries = [];

    public function addBattle(Battle $battle, GameTurn $gameTurn)
    {
        $battleRegistry = new BattleRegistry();
        $battleRegistry->setBattle($battle);
        $battleRegistry->setGameTurn($gameTurn);
        $this->battleRegistries[] = $battleRegistry;
    }

    public function getBattles(BattlesFilter $battlesFilter): array
    {
        // TODO use filter
        return $this->battleRegistries;
    }




}