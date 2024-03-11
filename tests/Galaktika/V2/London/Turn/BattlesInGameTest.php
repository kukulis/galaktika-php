<?php

namespace Tests\Galaktika\V2\London\Turn;

use Galaktika\SimpleIdGenerator;
use Galaktika\Util\SingletonsContainer;
use Galaktika\V2\Battle\BattleReport;
use Galaktika\V2\Battle\BattleReportLine;
use Galaktika\V2\Battle\CyclicSequence;
use Galaktika\V2\Battle\OneValueSequence;
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
//        $randomGenerator = new RandomSequence([
//            1,
//            1,
//            1,
//            1,
//            1,
//            1,
//            1,
//            1,
//            1
//        ]);

//        $randomGenerator = new OneValueSequence(0);

        $randomGenerator = new CyclicSequence([
            0,
            0.25,
            0.5,
            0.75,
            0.999
        ]);

        $turnMaker->setRandomGenerator($randomGenerator);

        $newGame = $turnMaker->makeTurn();

        $expectedBornIds = array_map(fn(Fleet $f) => $f->getBornId(), $expectedGame->getFleets());
        $bornIds = array_map(fn(Fleet $f) => $f->getBornId(), $newGame->getFleets());

        // in the new game fleets should be less

        $reports = $turnMaker->getBattleReports();
        $this->assertCount(count($expectedBattleReports), $reports);

        $this->assertEquals($expectedBornIds, $bornIds);

        $this->assertEquals( $expectedBattleReports[0]->getFleetA(),  $reports[0]->getFleetA());
        $this->assertEquals( $expectedBattleReports[0]->getFleetB(),  $reports[0]->getFleetB());
    }

    public static function provideTestingGames(): array
    {
        return [
//            'test battle 1x1' => [
//                'game' => (new GameTurn())
//                    ->setFleets([
//                        SingletonsContainer::instance()->getSingleton('fleet1', fn() => (new Fleet())
//                            ->setLocation(
//                                (new Location())
//                                    ->setX(10)
//                                    ->setY(10)
//                            )
//                            ->setBornId('origId1')
//                            ->addShip(
//                                SingletonsContainer::instance()->getSingleton('ship11', fn() => (new Ship())
//                                    ->setId('ship11')
//                                    ->setX(10)
//                                    ->setY(10)
//                                    ->setGuns(1)
//                                    ->setAttack(1)
//                                    ->setDefence(1)
//                                    ->setOwner((new Race())->setId('race1'))
//                                )
//                            )
//                        ),
//                        SingletonsContainer::instance()->getSingleton('fleet2', fn() => (new Fleet())
//                            ->setLocation(
//                                (new Location())
//                                    ->setX(10)
//                                    ->setY(10)
//                            )
//                            ->setBornId('origId2')
//                            ->addShip(
//                                SingletonsContainer::instance()->getSingleton('ship21', fn() => (new Ship())
//                                    ->setId('ship21')
//                                    ->setX(10)
//                                    ->setY(10)
//                                    ->setAttack(0)
//                                    ->setDefence(1)
//                                    ->setOwner((new Race())->setId('race2'))
//                                )
//                            )
//                        )
//                    ])
//                ,
//                'expectedGame' => (new GameTurn())
//                    ->setFleets([
//                        SingletonsContainer::instance()->getSingleton('fleet1')
//                    ])
//                ,
//
//                'expectedBattleReports' => [
//                    (new BattleReport())
//                        ->setBeforeFleetA(
//                            (new Fleet())
//                                ->addShip(SingletonsContainer::instance()->getSingleton('ship11'))
//                        )
//                        ->setFleetA(
//                            (new Fleet())
//                                ->addShip(SingletonsContainer::instance()->getSingleton('ship11'))
//                        )
//                        ->setBeforeFleetB(
//                            (new Fleet())
//                                ->addShip(SingletonsContainer::instance()->getSingleton('ship21'))
//                        )
//                        ->setFleetB((new Fleet()))
//                        ->addShot(
//                            (new BattleReportLine())
//                                ->setShooter(SingletonsContainer::instance()->getSingleton('ship11'))
//                                ->setTarget(SingletonsContainer::instance()->getSingleton('ship21'))
//                                ->setDestroyed(true)
//                        )
//                    ,
//                ]
//            ],
            'test battle 2x2' => [
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
                                    ->setOwner(
                                        SingletonsContainer::instance()->getSingleton('race1', fn() => (new Race(
                                        ))->setId('race1'))
                                    )
                                )
                            )
                            ->addShip(
                                SingletonsContainer::instance()->getSingleton('ship12', fn() => (new Ship())
                                    ->setId('ship12')
                                    ->setX(10)
                                    ->setY(10)
                                    ->setGuns(1)
                                    ->setAttack(1)
                                    ->setDefence(4)
                                    ->setOwner(SingletonsContainer::instance()->getSingleton('race1'))
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
                                    ->setAttack(1)
                                    ->setGuns(1)
                                    ->setDefence(1)
                                    ->setOwner(
                                        SingletonsContainer::instance()->getSingleton('race2', fn() => (new Race(
                                        ))->setId('race2'))
                                    )
                                )
                            )
                            ->addShip(
                                SingletonsContainer::instance()->getSingleton('ship22', fn() => (new Ship())
                                    ->setId('ship21')
                                    ->setX(10)
                                    ->setY(10)
                                    ->setAttack(1)
                                    ->setGuns(1)
                                    ->setDefence(4)
                                    ->setOwner(
                                        SingletonsContainer::instance()->getSingleton('race2')
                                    )
                                )
                            )

                        )
                    ])
                ,
                'expectedGame' => (new GameTurn())
                    ->setFleets([
                        SingletonsContainer::instance()->getSingleton('fleet1'),
                        SingletonsContainer::instance()->getSingleton('fleet2'),
                    ])
                ,

                'expectedBattleReports' => [
                    (new BattleReport())
                        ->setBeforeFleetA(
                            (new Fleet())
                                ->addShip(SingletonsContainer::instance()->getSingleton('ship11'))
                                ->addShip(SingletonsContainer::instance()->getSingleton('ship12'))
                        )
                        ->setFleetA(
                            (new Fleet())
                                ->addShip(SingletonsContainer::instance()->getSingleton('ship12'))
                        )
                        ->setBeforeFleetB(
                            (new Fleet())
                                ->addShip(SingletonsContainer::instance()->getSingleton('ship21'))
                                ->addShip(SingletonsContainer::instance()->getSingleton('ship22'))
                        )
                        ->setFleetB(
                            (new Fleet())
                                ->addShip(SingletonsContainer::instance()->getSingleton('ship22'))
                        )
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