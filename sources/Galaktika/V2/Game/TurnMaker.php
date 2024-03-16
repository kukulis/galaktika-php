<?php

namespace Galaktika\V2\Game;

use Galaktika\Exceptions\GalaktikaException;
use Galaktika\IdGenerator;
use Galaktika\V2\Battle\BattleCalculator;
use Galaktika\V2\Battle\BattleReport;
use Galaktika\V2\Data\Fleet;
use Galaktika\V2\Data\GameSettings;
use Galaktika\V2\Data\GameTurn;
use Galaktika\V2\Data\IDiplomacyMap;
use Galaktika\V2\Data\PlanetSurface;
use Galaktika\V2\Data\Race;
use Galaktika\V2\Math\IRandomGenerator;
use Galaktika\V2\Production\PopulationCalculator;
use Galaktika\V2\Space\ConflictFinder;
use Galaktika\V2\Space\FlyCalculator;

class TurnMaker
{
    const MAX_TURNS = 100;

    private IdGenerator $idGenerator;

    private GameTurn $gameTurn;
    private GameTurn $newGame;

    private GameSettings $gameSettings;

    private IDiplomacyMap $diplomacyMap;

    private IRandomGenerator $randomGenerator;

    /** @var BattleReport[] */
    private array $battleReports;

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

        $this->owners = [];

        $currentTurn = $this->gameTurn->getTurn();
        $newTurn = $currentTurn + 1;

        $this->newGame
            ->setName($this->gameTurn->getName())
            ->setTurn($newTurn)
            ->setPlanets($this->gameTurn->getPlanets());


        $this->cloneTechnologies($currentTurn, $newTurn);

        $this->executeBuilds();

        // fleets cloned there
        $this->executeFlights();
        $this->executeBattles();

        $this->flushDestroyedShips();

        $this->executeDestructions();

        return $this->newGame;
    }

    private function cloneTechnologies(int $currentTurn, int $newTurn)
    {
        /** @var Race[] $owners */
        $owners = [];
        // technologies clones
        foreach ($this->gameTurn->getSurfaces() as $surface) {
            if ($surface->getOwner() == null) {
                continue;
            }

            $owner = $surface->getOwner();

            if (array_key_exists($owner->getId(), $owners)) {
                continue;
            }
            $owners[$owner->getId()] = $owner;

            $technologies = $owner->getTechnologies($currentTurn);

            if ($technologies == null) {
                throw new GalaktikaException(
                    sprintf('Technologies not set for owner [%s], turn [%s]', $owner->getId(), $currentTurn)
                );
            }

            // this is why this cycle is made for
            $owner->setTechnologies(clone $technologies, $newTurn);
        }
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

        foreach ($surface->getCommands() as $command) {
            $command->execute($newSurface, $surface, $this->newGame->getTurn());
        }

        $newSurface->setPopulation(
            PopulationCalculator::calculatePopulation(
                $surface->getPopulation(),
                $this->gameSettings->getPopulationPercentage(),
                $newSurface->getPlanet()->getSize()
            )
        );

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
        // collect all ships
        $allShips = array_reduce(
            $this->gameTurn->getFleets(),
            fn($ships, Fleet $fleet) => array_merge($ships, $fleet->getShips()),
            []
        );

        // find battles
        $conflicts = ConflictFinder::findConflicts($allShips, $this->diplomacyMap);
        // execute battles

        $this->battleReports = [];
        foreach ($conflicts as $conflict) {
            $tmpFleetA = (new Fleet())->setShips($conflict->getSideShips(0));
            $tmpFleetB = (new Fleet())->setShips($conflict->getSideShips(1));

            $battleCalculator = new BattleCalculator(self::MAX_TURNS);
            $battleReport = $battleCalculator->battle($tmpFleetA, $tmpFleetB, $this->randomGenerator);

            $this->battleReports[] = $battleReport;
        }
    }

    public function executeDestructions()
    {
        // pair fleets with foreign surfaces TODO

    }

    public function setDiplomacyMap(IDiplomacyMap $diplomacyMap): TurnMaker
    {
        $this->diplomacyMap = $diplomacyMap;
        return $this;
    }

    public function setRandomGenerator(IRandomGenerator $randomGenerator): TurnMaker
    {
        $this->randomGenerator = $randomGenerator;
        return $this;
    }

    /**
     * @return BattleReport[]
     */
    public function getBattleReports(): array
    {
        return $this->battleReports;
    }

    protected function flushDestroyedShips()
    {
        $newGameFleets = $this->newGame->getFleets();
        array_walk($newGameFleets, fn(Fleet $fleet) => $fleet->flushDestroyedShips());
        $newGameFleets = array_filter($newGameFleets, fn(Fleet $f) => count($f->getShips()) > 0);
        $this->newGame->setFleets($newGameFleets);
    }
}