<?php

namespace Tests\Galaktika\V2\London\Turn;

use Galaktika\Data\Battle;
use Galaktika\SimpleIdGenerator;
use Galaktika\Util\SingletonsContainer;
use Galaktika\V2\Battle\BattleReport;
use Galaktika\V2\Data\DiplomacyMap;
use Galaktika\V2\Data\Fleet;
use Galaktika\V2\Data\GameSettings;
use Galaktika\V2\Data\GameTurn;
use Galaktika\V2\Data\Location;
use Galaktika\V2\Game\TurnMaker;
use PHPUnit\Framework\TestCase;

class BattlesInGameTest extends TestCase
{
    /**
     * @dataProvider provideTestingGames
     *
     * @param BattleReport[] $expectedBattleReports
     */
    public function testBattlesInTurn(GameTurn $game, GameTurn $expectedGame, array $expectedBattleReports)
    {
        $idGenerator = new SimpleIdGenerator();
        $gameSettings = new GameSettings();
        $diplomacyMap = new DiplomacyMap();
        $turnMaker = new TurnMaker($game, $idGenerator, $gameSettings);
        $turnMaker->setDiplomacyMap($diplomacyMap);

        $newGame = $turnMaker->makeTurn();

        $expectedBornIds = array_map ( fn(Fleet $f)=> $f->getBornId(), $expectedGame->getFleets());
        $bornIds = array_map ( fn(Fleet $f)=> $f->getBornId(), $newGame->getFleets());

        $reports = $turnMaker->getBattleReports();
        $this->assertEquals($expectedBattleReports, $reports);
        $this->assertEquals($expectedBornIds, $bornIds);
    }

    public static function provideTestingGames(): array
    {
        return [
            'test material' => [
                'game' => (new GameTurn())
                    ->setFleets([
                        SingletonsContainer::instance()->getSingleton('fleet1', fn() => (new Fleet())
                            ->setLocation(
                                (new Location())
                                    ->setX(10)
                                    ->setY(10)
                            )
                            ->setBornId('origId1')
                        ),
                        SingletonsContainer::instance()->getSingleton('fleet2', fn() => (new Fleet())
                            ->setLocation(
                                (new Location())
                                    ->setX(10)
                                    ->setY(10)
                            )
                            ->setBornId('origId2')
                        )
                    ])
                ,
                'expectedGame' => (new GameTurn())
                    ->setFleets([
                        SingletonsContainer::instance()->getSingleton('fleet1') // this will be a different fleet with the same base
                    ])
                ,

                'expectedBattleReports' => [
                    (new BattleReport())
                        ->setFleetA(SingletonsContainer::instance()->getSingleton('fleet1'))
                        ->setFleetB(SingletonsContainer::instance()->getSingleton('fleet2')),
                ]
            ],
        ];
    }
}