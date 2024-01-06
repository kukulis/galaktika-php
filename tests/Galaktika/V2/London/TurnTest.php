<?php

namespace Tests\Galaktika\V2\London;

use Galaktika\SimpleIdGenerator;
use Galaktika\V2\Data\Fleet;
use Galaktika\V2\Data\Game;
use Galaktika\V2\Data\Location;
use Galaktika\V2\Data\Planet;
use Galaktika\V2\Data\PlanetSurface;
use Galaktika\V2\Game\TurnMaker;
use PHPUnit\Framework\TestCase;

class TurnTest extends TestCase
{
    /**
     * @dataProvider provideGame
     */
    public function testTurn(Game $game, Game $expectedGame)
    {
        $idGenerator = new SimpleIdGenerator();
        $turnMaker = new TurnMaker($game, $idGenerator);

        $newGame = $turnMaker->makeTurn();

        $this->assertEquals($expectedGame->getName(), $newGame->getName());
        $this->assertEquals($expectedGame->getTurn(), $newGame->getTurn());
        $this->assertCount(count($expectedGame->getPlanets()), $newGame->getPlanets());


        $this->assertEquals($expectedGame->getPlanets(), $newGame->getPlanets());
        $this->assertCount(count($expectedGame->getSurfaces()), $newGame->getSurfaces());

        // checking only first surface
        if (count($expectedGame->getSurfaces()) > 0) {
            $expectedSurface = $expectedGame->getSurfaces()[0];
            $newSurface = $newGame->getSurfaces()[0];
            $surface = $game->getSurfaces()[0];

            $this->assertEquals($expectedSurface->getPlanet()->getId(), $newSurface->getPlanet()->getId());
            // all productions will be checked in a separate test

            $this->assertNotEquals($surface->getId(), $newSurface->getId());
        }

        $this->assertCount(count($expectedGame->getFleets()), $newGame->getFleets());
    }

    public function provideGame(): array
    {
        return [
            'test planets' => [
                'game' => (new Game())
                    ->setName('game')
                    ->setTurn(1)
                    ->setPlanets([
                        (new Planet())
                            ->setId(1)
                            ->setSize(100)
                            ->setLocation(
                                (new Location())
                                    ->setX(10)
                                    ->setY(20)
                            )
                    ])
                    ->setSurfaces([
                        (new PlanetSurface())
                            ->setPlanet((new Planet())->setId(1))
                            ->setId(111)
                    ])
                ,
                'expectedGame' =>
                    (new Game())
                        ->setName('game')
                        ->setTurn(2)
                        ->setPlanets([
                            (new Planet())
                                ->setId(1)
                                ->setSize(100)
                                ->setLocation(
                                    (new Location())
                                        ->setX(10)
                                        ->setY(20)
                                )
                        ])
                        ->setSurfaces([
                            (new PlanetSurface())
                                ->setPlanet((new Planet())->setId(1))
                                ->setId(111)
                        ])
                ,
            ],
            'test flights' => [
                'game' => (new Game())
                    ->setName('game')
                    ->setTurn(1)
                    ->setFleets([
                            new Fleet()
                        ]
                    )
                ,
                'expectedGame' =>
                    (new Game())
                        ->setName('game')
                        ->setTurn(2)
                        ->setFleets(
                            [
                                new Fleet()
                            ]
                        )
                ,
            ]
        ];
    }


}