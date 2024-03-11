<?php

namespace Tests\Galaktika\V2\London\Turn;

use Galaktika\SimpleIdGenerator;
use Galaktika\Util\SingletonsContainer;
use Galaktika\V2\Battle\BattleReport;
use Galaktika\V2\Battle\BattleReportLine;
use Galaktika\V2\Battle\RandomSequence;
use Galaktika\V2\Data\DiplomacyMap;
use Galaktika\V2\Data\Fleet;
use Galaktika\V2\Data\GameSettings;
use Galaktika\V2\Data\GameTurn;
use Galaktika\V2\Data\Location;
use Galaktika\V2\Data\Race;
use Galaktika\V2\Data\Ship;
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
        $randomGenerator = new RandomSequence([
            1,
            1,
            1,
            1,
            1,
            1,
            1,
            1,
            1
        ]);

        $turnMaker->setRandomGenerator($randomGenerator);

        $newGame = $turnMaker->makeTurn();

        $expectedBornIds = array_map(fn(Fleet $f) => $f->getBornId(), $expectedGame->getFleets());
        $bornIds = array_map(fn(Fleet $f) => $f->getBornId(), $newGame->getFleets());

        // in the new game fleets should be less

        $reports = $turnMaker->getBattleReports();
        $this->assertEquals($expectedBattleReports, $reports);

        $this->assertEquals($expectedBornIds, $bornIds);

        // TODO assert fleets after battle, lets make other test data first
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
                            ->addShip(
                                SingletonsContainer::instance()->getSingleton('ship11', fn() => (new Ship())
                                    ->setId('ship11')
                                    ->setX(10)
                                    ->setY(10)
                                    ->setGuns(1)
                                    ->setAttack(1)
                                    ->setDefence(1)
                                    ->setOwner((new Race())->setId('race1'))
                                )
                            )
                        ),
                        SingletonsContainer::instance()->getSingleton('fleet2', fn() => (new Fleet())
                            ->setLocation(
                                (new Location())
                                    ->setX(10)
                                    ->setY(10)
                            )
                            ->setBornId('origId2')
                            ->addShip(
                                SingletonsContainer::instance()->getSingleton('ship21', fn() => (new Ship())
                                    ->setId('ship21')
                                    ->setX(10)
                                    ->setY(10)
                                    ->setAttack(0)
                                    ->setDefence(1)
                                    ->setOwner((new Race())->setId('race2'))
                                )
                            )
                        )
                    ])
                ,
                'expectedGame' => (new GameTurn())
                    ->setFleets([
                        SingletonsContainer::instance()->getSingleton('fleet1')
                    ])
                ,

                'expectedBattleReports' => [
                    (new BattleReport())
                        ->setBeforeFleetA(
                            (new Fleet())
                                ->addShip(SingletonsContainer::instance()->getSingleton('ship11'))
                        )
                        ->setFleetA(
                            (new Fleet())
                                ->addShip(SingletonsContainer::instance()->getSingleton('ship11'))
                        )
                        ->setBeforeFleetB(
                            (new Fleet())
                                ->addShip(SingletonsContainer::instance()->getSingleton('ship21'))
                        )
                        ->setFleetB((new Fleet()))
                        ->addShot(
                            (new BattleReportLine())
                                ->setShooter(SingletonsContainer::instance()->getSingleton('ship11'))
                                ->setTarget(SingletonsContainer::instance()->getSingleton('ship21'))
                                ->setDestroyed(true)
                        )
                    ,
                ]
            ],
        ];
    }
}