<?php

namespace Tests\Galaktika\V2\London\Turn;

use Galaktika\SimpleIdGenerator;
use Galaktika\V2\Data\DiplomacyMap;
use Galaktika\V2\Data\GameSettings;
use Galaktika\V2\Data\GameTurn;
use Galaktika\V2\Game\TurnMaker;
use PHPUnit\Framework\TestCase;

class BattlesInGameTest extends TestCase
{
    /**
     * @dataProvider provideTestingGames
     */
    public function testBattlesInTurn(GameTurn $game, GameTurn $expectedGame)
    {
        $idGenerator = new SimpleIdGenerator();
        $gameSettings = new GameSettings();
        $diplomacyMap = new DiplomacyMap();
        $turnMaker = new TurnMaker($game, $idGenerator, $gameSettings);
        $turnMaker->setDiplomacyMap($diplomacyMap);

        $newGame = $turnMaker->makeTurn();

        // TODO

        $this->assertTrue(true);
    }

    public static function provideTestingGames(): array
    {
        return [
            'test material' => [
                'game' => (new GameTurn())
                // TODO
                ,
                'expectedGame' => (new GameTurn())
                // TODO
                ,

            ],
        ];
    }
}