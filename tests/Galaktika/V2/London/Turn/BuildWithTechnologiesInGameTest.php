<?php

namespace Tests\Galaktika\V2\London\Turn;

use Galaktika\SimpleIdGenerator;
use Galaktika\Util\SingletonsContainer;
use Galaktika\V2\Data\GameSettings;
use Galaktika\V2\Data\GameTurn;
use Galaktika\V2\Data\Planet;
use Galaktika\V2\Data\PlanetSurface;
use Galaktika\V2\Data\Race;
use Galaktika\V2\Data\Technologies;
use Galaktika\V2\Game\TurnMaker;
use Galaktika\V2\Production\ResearchCommand;
use PHPUnit\Framework\TestCase;

class BuildWithTechnologiesInGameTest extends TestCase
{

    /**
     * @dataProvider provideGamesForTest
     */
    public function testBuildInGame(GameTurn $gameTurn, GameTurn $expectedGameTurn)
    {
        $idGenerator = new SimpleIdGenerator();
        $gameSettings = new GameSettings();
        $turnMaker = new TurnMaker($gameTurn, $idGenerator, $gameSettings);


        $newGameTurn = $turnMaker->makeTurn();

        $this->assertEquals($expectedGameTurn->getTurn(), $newGameTurn->getTurn());

        $newTechnologies = $newGameTurn->getSurfaces()[0]->getOwner()->getTechnologies($newGameTurn->getTurn());
        $expectedTechnologies = $expectedGameTurn->getSurfaces()[0]->getOwner()->getTechnologies(
            $expectedGameTurn->getTurn()
        );
        $oldTechnologies = $gameTurn->getSurfaces()[0]->getOwner()->getTechnologies($gameTurn->getTurn());

        $this->assertNotTrue($oldTechnologies === $newTechnologies);

        $this->assertEquals($expectedTechnologies, $newTechnologies);

        // not the same object
        $this->assertFalse($expectedTechnologies === $newTechnologies);
    }

    public static function provideGamesForTest(): array
    {
        return [
            'test two planets' => [
                'gameTurn' => (new GameTurn())
                    ->setTurn(1)
                    ->setSurfaces([
                        (new PlanetSurface())
                            ->setId('surf1')
                            ->setPlanet(
                                (new Planet())
                                    ->setId('p1')
                            )
                            ->setOwner(
                                SingletonsContainer::instance()->getSingleton(
                                    'race1', fn() => (new Race())->setId('race1')
                                    ->setTechnologies(
                                        (new Technologies())->setEngines(1)
                                    )
                                )
                            )
                            ->setPopulation(40)
                            ->setIndustry(100)
                            ->setCommands([
                                (new ResearchCommand())->setTechnologyType(Technologies::TYPE_DEFENCE)
                            ]),
                        (new PlanetSurface())
                            ->setId('surf2')
                            ->setPlanet(
                                (new Planet())
                                    ->setId('p2')
                            )
                            ->setOwner(SingletonsContainer::instance()->getSingleton('race1'))
                            ->setPopulation(100)
                            ->setIndustry(60)
                            ->setCommands([
                                (new ResearchCommand())->setTechnologyType(Technologies::TYPE_DEFENCE)
                            ]),
                    ])
                ,
                'expectedGameTurn' => (new GameTurn())
                    ->setTurn(2)
                    ->setSurfaces([
                        (new PlanetSurface())
                            ->setId('surf1')
                            ->setPlanet(
                                (new Planet())
                                    ->setId('p1')
                            )
                            ->setOwner(
                                SingletonsContainer::instance()->getSingleton(
                                    'expRace',
                                    fn() => (new Race())->setTechnologies(
                                        (new Technologies())->setDefence(2),
                                        2
                                    )
                                )
                            ),
                        (new PlanetSurface())
                            ->setId('surf2')
                            ->setPlanet(
                                (new Planet())
                                    ->setId('p2')
                            )
                            ->setOwner(SingletonsContainer::instance()->getSingleton('expRace')),
                    ])
            ]
        ];
    }
}