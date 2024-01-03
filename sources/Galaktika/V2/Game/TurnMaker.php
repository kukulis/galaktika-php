<?php

namespace Galaktika\V2\Game;

use Galaktika\IdGenerator;
use Galaktika\V2\Data\Game;

class TurnMaker
{

    private IdGenerator $idGenerator;

    private Game $game;

    /**
     * @param IdGenerator $idGenerator
     */
    public function __construct(Game $game, IdGenerator $idGenerator)
    {
        $this->idGenerator = $idGenerator;
        $this->game = $game;
    }


    public function makeTurn(): Game
    {
        $newGame = new Game();

        $newGame
            ->setName($this->game->getName())
            ->setTurn($this->game->getTurn() + 1)
            ->setPlanets($this->game->getPlanets());

        $surfaces = $this->game->getSurfaces();
        $newSurfaces = array_map(fn($s) => (clone($s))->setId($this->idGenerator->generateId()), $surfaces);

        $this->executeBuilds();
        $this->executeFlights();
        $this->executeFights();
        $this->executeDestructions();

        $newGame->setSurfaces($newSurfaces);

        return $newGame;
    }

    public function executeBuilds(): void
    {
        // TODO make calculations, using other services
    }

    public function executeFlights()
    {
    }

    public function executeFights()
    {
    }

    public function executeDestructions()
    {
    }
}