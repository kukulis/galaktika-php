<?php

namespace Galaktika\V2\Game;

use Galaktika\IdGenerator;
use Galaktika\V2\Data\Game;
use Galaktika\V2\Space\FlyCalculator;

class TurnMaker
{

    private IdGenerator $idGenerator;

    private Game $game;
    private Game $newGame;

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
        $this->newGame = new Game();

        $this->newGame
            ->setName($this->game->getName())
            ->setTurn($this->game->getTurn() + 1)
            ->setPlanets($this->game->getPlanets());

        $surfaces = $this->game->getSurfaces();
        $newSurfaces = array_map(fn($s) => (clone($s))->setId($this->idGenerator->generateId()), $surfaces);
        $this->newGame->setSurfaces($newSurfaces);

//        $fleets = $this->game->getFleets();
//
//        $newFleets = array_map()
//

        $this->executeBuilds();
        $this->executeFlights();
        $this->executeBattles();
        $this->executeDestructions();


        return $this->newGame;
    }

    public function executeBuilds(): void
    {
        // TODO make calculations, using other services
    }

    public function executeFlights()
    {
        $fleets = $this->game->getFleets();
        $newFleets = array_map(fn($fleet) => FlyCalculator::flyFleet($fleet)->setId($this->idGenerator->generateId()),
            $fleets);
        $this->newGame->setFleets($newFleets);
    }
    public function executeBattles()
    {

    }

    public function executeDestructions()
    {
    }
}