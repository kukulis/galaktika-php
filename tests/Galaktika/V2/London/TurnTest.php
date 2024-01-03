<?php

namespace Tests\Galaktika\V2\London;

use Galaktika\V2\Data\Game;
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
    }

    public function provideGame(): array
    {
        return [
            'test1' => [
                'game' => (new Game())
                    ->setName('game')
                    ->setTurn(1)
                ,
                'expectedGame' =>
                    (new Game())
                        ->setName('game')
                        ->setTurn(2)
            ]
        ];
    }


}