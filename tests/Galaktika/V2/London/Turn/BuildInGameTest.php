<?php

namespace Tests\Galaktika\V2\London\Turn;

use Galaktika\SimpleIdGenerator;
use Galaktika\V2\Data\GameSettings;
use Galaktika\V2\Data\GameTurn;
use Galaktika\V2\Data\Planet;
use Galaktika\V2\Data\PlanetSurface;
use Galaktika\V2\Game\TurnMaker;
use Galaktika\V2\Production\MaterialCommand;
use PHPUnit\Framework\TestCase;

class BuildInGameTest extends TestCase
{
    /**
     * @dataProvider provideTestingGames
     */
    public function testBuild(GameTurn $game, GameTurn $expectedGame)
    {
        $idGenerator = new SimpleIdGenerator();
        $gameSettings = new GameSettings();
        $turnMaker = new TurnMaker($game, $idGenerator, $gameSettings);

        $newGame = $turnMaker->makeTurn();
        $this->assertCount(count($expectedGame->getSurfaces()), $newGame->getSurfaces());
        $this->assertNotEquals($game->getSurfaces()[0]->getId(), $newGame->getSurfaces()[0]->getId());

        $this->assertEquals(
            $expectedGame->getSurfaces()[0]->getPlanet()->getId(),
            $newGame->getSurfaces()[0]->getPlanet()->getId()
        );

        $this->assertEquals(
            $expectedGame->getSurfaces()[0]->getPopulation(),
            $newGame->getSurfaces()[0]->getPopulation()
        );
        $this->assertEquals(
            $expectedGame->getSurfaces()[0]->getIndustry(),
            $newGame->getSurfaces()[0]->getIndustry()
        );
        $this->assertEquals(
            $expectedGame->getSurfaces()[0]->getMaterial(),
            $newGame->getSurfaces()[0]->getMaterial()
        );
        // ??
        $this->assertEquals(
            $expectedGame->getSurfaces()[0]->getShips(),
            $newGame->getSurfaces()[0]->getShips()
        );
    }

    public static function provideTestingGames(): array
    {
        return [
            'test1' => [
                'game' => (new GameTurn())
                    ->setSurfaces([
                        (new PlanetSurface())
                            ->setId('s1')
                            ->setPlanet(
                                (new Planet())
                                    ->setId('planet1')
                                    ->setSize(100)
                            )
                            ->setPopulation(50)
                            ->setIndustry(50)
                            ->setMaterial(50)
                            ->setShips([])
                            ->setCommands([
                                new MaterialCommand()
                            ])
                    ]),
                'expectedGame' => (new GameTurn())->setSurfaces([
                    (new PlanetSurface())
                        ->setId('s1+')
                        ->setPlanet(
                            (new Planet())
                                ->setId('planet1')
                                ->setSize(100)
                        )
                        ->setPopulation(65)
                        ->setIndustry(50)
                        ->setMaterial(100)
                        ->setShips([])
                ])
                ,
            ]
        ];
    }
}