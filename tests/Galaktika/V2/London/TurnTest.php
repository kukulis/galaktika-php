<?php

namespace Tests\Galaktika\V2\London;

use Galaktika\SimpleIdGenerator;
use Galaktika\V2\Data\Fleet;
use Galaktika\V2\Data\GameSettings;
use Galaktika\V2\Data\GameTurn;
use Galaktika\V2\Data\Location;
use Galaktika\V2\Data\Planet;
use Galaktika\V2\Data\PlanetSurface;
use Galaktika\V2\Data\Ship;
use Galaktika\V2\Game\TurnMaker;
use PHPUnit\Framework\TestCase;

class TurnTest extends TestCase
{
    /**
     * @dataProvider provideGame
     */
    public function testTurn(GameTurn $game, GameTurn $expectedGame)
    {
        $idGenerator = new SimpleIdGenerator();
        $gameSetting = new GameSettings();
        $turnMaker = new TurnMaker($game, $idGenerator, $gameSetting);

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

        if (count($newGame->getFleets()) > 0) {
            $newFleet = $newGame->getFleets()[0];
            $expectedFleet = $expectedGame->getFleets()[0];

            $this->assertEquals($expectedFleet->getLocation(), $newFleet->getLocation());

            $this->assertCount(count($expectedFleet->getShips()), $newFleet->getShips());
        }
    }

    public static function provideGame(): array
    {
        return [
            'test planets' => self::provideGamesForTestPlanets(),
            'test flights' => self::provideGamesForTestFlights(),
        ];
    }

    private static function provideGamesForTestPlanets(): array
    {
        $planet1 = (new Planet())
            ->setId(1)
            ->setSize(100)
            ->setLocation(
                (new Location())
                    ->setX(10)
                    ->setY(20)
            );

        return [
            'game' => (new GameTurn())
                ->setName('game')
                ->setTurn(1)
                ->setPlanets([
                    $planet1
                ])
                ->setSurfaces([
                    (new PlanetSurface())
                        ->setPlanet($planet1)
                        ->setId(111)
                        ->setPopulation(100)
                        ->setIndustry(50)
                ])
            ,
            'expectedGame' =>
                (new GameTurn())
                    ->setName('game')
                    ->setTurn(2)
                    ->setPlanets([
                        $planet1
                    ])
                    ->setSurfaces([
                        (new PlanetSurface())
                            ->setPlanet($planet1)
                            ->setId(111)
                    ])
            ,
        ];
    }

    private static function provideGamesForTestFlights(): array
    {
        return [
            'game' => (new GameTurn())
                ->setName('game')
                ->setTurn(1)
                ->setFleets([
                        (new Fleet())
                            ->setLocation(
                                (new Location())
                                    ->setX(1)
                                    ->setY(1)
                            )
                            ->setDirection(0)
                            ->addShip(
                                (new Ship())->setSpeed(1)
                            )

                    ]
                )
            ,
            'expectedGame' =>
                (new GameTurn())
                    ->setName('game')
                    ->setTurn(2)
                    ->setFleets(
                        [
                            (new Fleet())
                                ->setLocation(
                                    (new Location())->setX(2)->setY(1)
                                )
                                ->addShip(new Ship())
                        ]
                    )
            ,
        ];
    }

}