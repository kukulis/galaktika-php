<?php

namespace Tests\Galaktika\V2\London\Turn;

use Galaktika\SequenceIdGenerator;
use Galaktika\SimpleIdGenerator;
use Galaktika\V2\Data\DiplomacyMap;
use Galaktika\V2\Data\GameSettings;
use Galaktika\V2\Data\GameTurn;
use Galaktika\V2\Data\Planet;
use Galaktika\V2\Data\PlanetSurface;
use Galaktika\V2\Data\Race;
use Galaktika\V2\Data\Ship;
use Galaktika\V2\Data\Technologies;
use Galaktika\V2\Game\TurnMaker;
use Galaktika\V2\Production\IndustryCommand;
use Galaktika\V2\Production\MaterialCommand;
use Galaktika\V2\Production\ResearchCommand;
use Galaktika\V2\Production\ShipCommand;
use Galaktika\V2\Production\ShipModel;
use PHPUnit\Framework\TestCase;

class BuildInGameTest extends TestCase
{
    /**
     * @dataProvider provideTestingGames
     */
    public function testBuild(GameTurn $game, GameTurn $expectedGame)
    {
        $idGenerator = new SimpleIdGenerator();
        $gameSettings = new GameSettings();
        $diplomacyMap = new DiplomacyMap();
        $turnMaker = new TurnMaker($game, $idGenerator, $gameSettings);
        $turnMaker->setDiplomacyMap($diplomacyMap);

        $newGame = $turnMaker->makeTurn();
        $this->assertCount(count($expectedGame->getSurfaces()), $newGame->getSurfaces());
        $this->assertNotEquals($game->getSurfaces()[0]->getId(), $newGame->getSurfaces()[0]->getId());

        $this->assertEquals(
            $expectedGame->getSurfaces()[0]->getPlanet()->getId(),
            $newGame->getSurfaces()[0]->getPlanet()->getId()
        );

        $this->assertEquals(
            $expectedGame->getSurfaces()[0]->getPopulation(),
            $newGame->getSurfaces()[0]->getPopulation()
        );
        $this->assertEquals(
            $expectedGame->getSurfaces()[0]->getIndustry(),
            $newGame->getSurfaces()[0]->getIndustry()
        );
        $this->assertEquals(
            $expectedGame->getSurfaces()[0]->getMaterial(),
            $newGame->getSurfaces()[0]->getMaterial()
        );
        // ??
        $this->assertEquals(
            $expectedGame->getSurfaces()[0]->getShips(),
            $newGame->getSurfaces()[0]->getShips()
        );
    }

    public static function provideTestingGames(): array
    {
        return [
            'test material' => [
                'game' => (new GameTurn())
                    ->setSurfaces([
                        (new PlanetSurface())
                            ->setId('s1')
                            ->setPlanet(
                                (new Planet())
                                    ->setId('planet1')
                                    ->setSize(100)
                            )
                            ->setPopulation(50)
                            ->setIndustry(50)
                            ->setMaterial(50)
                            ->setShips([])
                            ->setCommands([
                                new MaterialCommand()
                            ])
                    ]),
                'expectedGame' => (new GameTurn())->setSurfaces([
                    (new PlanetSurface())
                        ->setId('s1+')
                        ->setPlanet(
                            (new Planet())
                                ->setId('planet1')
                                ->setSize(100)
                        )
                        ->setPopulation(65)
                        ->setIndustry(50)
                        ->setMaterial(100)
                        ->setShips([])
                ])
                ,
            ],
            'test industry' => [
                'game' => (new GameTurn())
                    ->setSurfaces([
                        (new PlanetSurface())
                            ->setId('s1')
                            ->setPlanet(
                                (new Planet())
                                    ->setId('planet1')
                                    ->setSize(100)
                            )
                            ->setPopulation(50)
                            ->setIndustry(50)
                            ->setMaterial(50)
                            ->setShips([])
                            ->setCommands([
                                new IndustryCommand()
                            ])
                    ]),
                'expectedGame' => (new GameTurn())->setSurfaces([
                    (new PlanetSurface())
                        ->setId('s1+')
                        ->setPlanet(
                            (new Planet())
                                ->setId('planet1')
                                ->setSize(100)
                        )
                        ->setPopulation(65)
                        ->setIndustry(100)
                        ->setMaterial(0)
                        ->setShips([])
                ])
                ,
            ],
            'test ships' => [
                'game' => (new GameTurn())
                    ->setSurfaces([
                        (new PlanetSurface())
                            ->setId('s1')
                            ->setPlanet(
                                (new Planet())
                                    ->setId('planet1')
                                    ->setSize(100)
                            )
                            ->setPopulation(50)
                            ->setIndustry(50)
                            ->setMaterial(50)
                            ->setShips([])
                            ->setCommands([
                                (new ShipCommand())
                                    ->setModelToBuild(
                                        (new ShipModel())
                                            ->setId('test model id')
                                            ->setName('test ship')
                                            ->setEngineMass(10)
                                            ->setGuns(1)
                                            ->setAttackMass(10)
                                            ->setDefenceMass(10)
                                            ->setCargoMass(10)
                                    )
                                    ->setIdGenerator(new SequenceIdGenerator(['id1', 'id2', 'id3']))
                                    ->setTargetAmount(1)
                            ])
                            ->setOwner(
                                (new Race())
                                    ->setId('race1')
                                    ->setTechnologies(new Technologies())
                            )
                    ]),
                'expectedGame' => (new GameTurn())->setSurfaces([
                    (new PlanetSurface())
                        ->setId('s1+')
                        ->setPlanet(
                            (new Planet())
                                ->setId('planet1')
                                ->setSize(100)
                        )
                        ->setPopulation(65)
                        ->setIndustry(50)
                        ->setMaterial(10)
                        ->setShips([
                            (new Ship())
                                ->setGuns(1)
                                ->setAttack(10)
                                ->setDefence(1.8257418583506)
                                ->setSpeed(0.25)
                                ->setMaxCargo(10)
                                ->setMass(40)
                                ->setId('id1')
                                ->setModelId('test model id')
                                ->setModelName('test ship')
                        ])
                ]),
            ],

            'test technologies' => [
                'game' => (new GameTurn())
                    ->setSurfaces([
                        (new PlanetSurface())
                            ->setId('s1')
                            ->setPlanet(
                                (new Planet())
                                    ->setId('planet1')
                                    ->setSize(100)
                            )
                            ->setPopulation(50)
                            ->setIndustry(50)
                            ->setMaterial(50)
                            ->setShips([])
                            ->setCommands([
                                (new ResearchCommand())
                                    ->setTechnologyType(Technologies::TYPE_ENGINES)
                                    ->setGoalAmount(10)
                            ])
                            ->setOwner(
                                (new Race())
                                    ->setId('race1')
                                    ->setTechnologies(new Technologies())
                            )
                    ]),
                'expectedGame' => (new GameTurn())->setSurfaces([
                    (new PlanetSurface())
                        ->setId('s1+')
                        ->setPlanet(
                            (new Planet())
                                ->setId('planet1')
                                ->setSize(100)
                        )
                        ->setPopulation(65)
                        ->setIndustry(50)
                        ->setMaterial(50)
                ]),
            ],
        ];
    }
}