<?php

namespace Tests\Galaktika\V2\London\Turn;

use Galaktika\Util\SingletonsContainer;
use Galaktika\V2\Data\GameTurn;
use Galaktika\V2\Data\Planet;
use Galaktika\V2\Data\PlanetSurface;
use Galaktika\V2\Data\Race;
use Galaktika\V2\Data\Technologies;
use Galaktika\V2\Production\ResearchCommand;
use PHPUnit\Framework\TestCase;

class BuildWithTechnologiesInGameTest extends TestCase
{

    /**
     * @dataProvider provideGamesForTest
     */
    public function testBuildInGame(GameTurn $gameTurn, GameTurn $newGameTurn)
    {
        //TODO

        $this->assertTrue(true);
    }

    public static function provideGamesForTest(): array
    {
        return [
            'test two planets' => [
                'gameTurn' => (new GameTurn())
                    ->setSurfaces([
                        (new PlanetSurface())
                            ->setId('surf1')
                            ->setPlanet(
                                (new Planet())
                                    ->setId('p1')
                            )
                            ->setOwner(
                                SingletonsContainer::instance()->getSingleton(
                                    'race1', fn() => (new Race())->setTechnologies(new Technologies())
                                )
                            )
                            ->setCommands([
                                new ResearchCommand()
                            ]),
                        (new PlanetSurface())
                            ->setId('surf2')
                            ->setPlanet(
                                (new Planet())
                                    ->setId('p2')
                            )
                            ->setOwner(SingletonsContainer::instance()->getSingleton('race1'))
                            ->setCommands([
                                new ResearchCommand()
                            ]),
                    ])
                ,
                'newGameTurn' => (new GameTurn())
                    ->setSurfaces([
                        (new PlanetSurface())
                            ->setId('surf1')
                            ->setPlanet(
                                (new Planet())
                                    ->setId('p1')
                            )
                            ->setOwner(SingletonsContainer::instance()->getSingleton('race1')),
                        (new PlanetSurface())
                            ->setId('surf2')
                            ->setPlanet(
                                (new Planet())
                                    ->setId('p2')
                            )
                            ->setOwner(SingletonsContainer::instance()->getSingleton('race1')),
                    ])
            ]
        ];
    }
}