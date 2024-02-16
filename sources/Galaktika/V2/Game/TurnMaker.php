<?php

namespace Galaktika\V2\Game;

use Galaktika\IdGenerator;
use Galaktika\V2\Data\GameSettings;
use Galaktika\V2\Data\GameTurn;
use Galaktika\V2\Data\PlanetSurface;
use Galaktika\V2\Production\PopulationCalculator;
use Galaktika\V2\Space\FlyCalculator;

class TurnMaker
{

    private IdGenerator $idGenerator;

    private GameTurn $gameTurn;
    private GameTurn $newGame;

    private GameSettings $gameSettings;

    /**
     * @param IdGenerator $idGenerator
     */
    public function __construct(GameTurn $gameTurn, IdGenerator $idGenerator, GameSettings $gameSettings)
    {
        $this->idGenerator = $idGenerator;
        $this->gameTurn = $gameTurn;
        $this->gameSettings = $gameSettings;
    }


    public function makeTurn(): GameTurn
    {
        $this->newGame = new GameTurn();

        $this->newGame
            ->setName($this->gameTurn->getName())
            ->setTurn($this->gameTurn->getTurn() + 1)
            ->setPlanets($this->gameTurn->getPlanets());


        $this->executeBuilds();
        $this->executeFlights();
        $this->executeBattles();
        $this->executeDestructions();


        return $this->newGame;
    }

    public function executeBuilds(): void
    {
        $surfaces = $this->gameTurn->getSurfaces();
        $newSurfaces = array_map(fn($s) => $this->executeSurfaceBuild($s), $surfaces);
        $this->newGame->setSurfaces($newSurfaces);
    }

    public function executeSurfaceBuild(PlanetSurface $surface): PlanetSurface
    {
        $newSurface = clone($surface);
        $newSurface->setId($this->idGenerator->generateId());

        $newSurface->setPopulation(
            PopulationCalculator::calculatePopulation(
                $surface->getPopulation(),
                $this->gameSettings->getPopulationPercentage(),
                $newSurface->getPlanet()->getSize()
            )
        );

        foreach ($surface->getCommands() as $command) {
            $command->execute($newSurface, $surface);
        }

        return $newSurface;
    }

    public function executeFlights()
    {
        $fleets = $this->gameTurn->getFleets();
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