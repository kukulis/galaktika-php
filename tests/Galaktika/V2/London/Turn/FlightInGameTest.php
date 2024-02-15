<?php

namespace Tests\Galaktika\V2\London\Turn;

use Galaktika\SimpleIdGenerator;
use Galaktika\V2\Data\Fleet;
use Galaktika\V2\Data\Game;
use Galaktika\V2\Data\Location;
use Galaktika\V2\Data\Ship;
use Galaktika\V2\Game\TurnMaker;
use PHPUnit\Framework\TestCase;

class FlightInGameTest extends TestCase
{
    /**
     * @dataProvider provideTestingGames
     */
    public function testTurn(Game $game, Game $expectedGame) {
        $idGenerator = new SimpleIdGenerator();
        $turnMaker = new TurnMaker($game, $idGenerator);

        $newGame = $turnMaker->makeTurn();

        $this->assertCount( count($expectedGame->getFleets()), $newGame->getFleets() );

        if ( count($expectedGame->getFleets()) == 0) {
            return;
        }

        $this->assertEquals( $expectedGame->getFleets()[0]->getBornId(), $newGame->getFleets()[0]->getBornId());
        $this->assertNotEquals( $game->getFleets()[0]->getId(), $newGame->getFleets()[0]->getId());
        $this->assertEquals($expectedGame->getFleets()[0]->getLocation(), $newGame->getFleets()[0]->getLocation());
    }

    public static function provideTestingGames() : array {
        return [
            'test1' => [
                'game' => (new Game())->setFleets([
                    (new Fleet())
                        ->setBornId('abc')
                        ->setId('123')
                        ->setShips([
                            (new Ship())->setSpeed(10)
                        ])
                        ->setLocation(
                            (new Location())->setX(5)->setY(5)
                        )
                        ->setDirection(pi()/2)
                ]),
                'expectedGame' => (new Game())->setFleets([
                    (new Fleet())
                        ->setBornId('abc')
                        ->setId('other')
                        ->setShips([
                            (new Ship())->setSpeed(10)
                        ])
                        ->setLocation(
                            (new Location())->setX(5)->setY(15)
                        )
                ]),
            ]
        ];
    }
}