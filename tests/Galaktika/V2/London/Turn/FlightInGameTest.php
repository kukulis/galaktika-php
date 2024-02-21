<?php

namespace Tests\Galaktika\V2\London\Turn;

use Galaktika\SimpleIdGenerator;
use Galaktika\V2\Data\DiplomacyMap;
use Galaktika\V2\Data\Fleet;
use Galaktika\V2\Data\GameSettings;
use Galaktika\V2\Data\GameTurn;
use Galaktika\V2\Data\Location;
use Galaktika\V2\Data\Race;
use Galaktika\V2\Data\Ship;
use Galaktika\V2\Game\TurnMaker;
use PHPUnit\Framework\TestCase;

class FlightInGameTest extends TestCase
{
    /**
     * @dataProvider provideTestingGames
     */
    public function testTurn(GameTurn $game, GameTurn $expectedGame) {
        $idGenerator = new SimpleIdGenerator();
        $gameSettings = new GameSettings();
        $turnMaker = new TurnMaker($game, $idGenerator, $gameSettings);
        $turnMaker->setDiplomacyMap(new DiplomacyMap());

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
                'game' => (new GameTurn())->setFleets([
                    (new Fleet())
                        ->setBornId('abc')
                        ->setId('123')
                        ->setShips([
                            (new Ship())->setSpeed(10)->setX(0)->setY(0)->setOwner(new Race())
                        ])
                        ->setLocation(
                            (new Location())->setX(5)->setY(5)
                        )
                        ->setDirection(pi()/2)
                ]),
                'expectedGame' => (new GameTurn())->setFleets([
                    (new Fleet())
                        ->setBornId('abc')
                        ->setId('other')
                        ->setShips([
                            (new Ship())->setSpeed(10)->setX(0)->setY(0)->setOwner(new Race())
                        ])
                        ->setLocation(
                            (new Location())->setX(5)->setY(15)
                        )
                ]),
            ]
        ];
    }
}