<?php

namespace Galaktika\V2\Game;

use Galaktika\V2\Data\Game;

class TurnMaker
{
    public function makeTurn(Game $game): Game
    {
        $newGame = new Game();

        $newGame
            ->setName($game->getName())
            ->setTurn($game->getTurn() + 1)
            ->setPlanets($game->getPlanets())
        ;

        $newGame->setSurfaces($game->getSurfaces());

        return $newGame;
    }
}