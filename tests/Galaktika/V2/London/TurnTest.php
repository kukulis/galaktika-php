<?php

namespace Tests\Galaktika\V2\London;

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
        $turnMaker = new TurnMaker();

        $newGame = $turnMaker->makeTurn($game);

        $this->assertEquals($expectedGame->getName(), $newGame->getName());
        $this->assertEquals($expectedGame->getTurn(), $newGame->getTurn());
        $this->assertCount(count($expectedGame->getPlanets()), $newGame->getPlanets());

//        // we will check only first planet for now - this is only about planet surfaces
//        $expectedPlanet = $expectedGame->getPlanets()[0];
//        $planet = $newGame->getPlanets()[0];
//
//        $this->assertEquals($expectedPlanet->getId(), $planet->getId());
//        $this->assertEquals($expectedPlanet->getSize(), $planet->getSize());
//        $this->assertEquals($expectedPlanet->getLocation(), $planet->getLocation());

        $this->assertEquals($expectedGame->getPlanets(), $newGame->getPlanets());

        $this->assertCount(count($expectedGame->getSurfaces()), $newGame->getSurfaces());

        // checking only first surface
        $expectedSurface = $expectedGame->getSurfaces()[0];
        $newSurface = $newGame->getSurfaces()[0];

        $this->assertEquals($expectedSurface->getPlanet()->getId(), $newSurface->getPlanet()->getId());
        // all productions will be checked in a separate test
    }

    public function provideGame(): array
    {
        return [
            'test1' => [
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
                        ])
                ,
            ]
        ];
    }


}