<?php

namespace Tests\Galaktika\V2\London\Turn;

use Galaktika\SimpleIdGenerator;
use Galaktika\V2\Data\DiplomacyMap;
use Galaktika\V2\Data\Fleet;
use Galaktika\V2\Data\GameSettings;
use Galaktika\V2\Data\GameTurn;
use Galaktika\V2\Data\Location;
use Galaktika\V2\Data\Planet;
use Galaktika\V2\Data\PlanetSurface;
use Galaktika\V2\Data\Race;
use Galaktika\V2\Data\Ship;
use Galaktika\V2\Data\Technologies;
use Galaktika\V2\Game\TurnMaker;
use PHPUnit\Framework\TestCase;

class DestructionsInGameTest extends TestCase
{
    /**
     * @dataProvider provideTestingGames
     */
    public function testDestructionsInTurn(GameTurn $game, GameTurn $expectedGame)
    {
        $idGenerator = new SimpleIdGenerator();
        $gameSettings = new GameSettings();
        $diplomacyMap = new DiplomacyMap();
        $turnMaker = new TurnMaker($game, $idGenerator, $gameSettings);
        $turnMaker->setDiplomacyMap($diplomacyMap);
        $newGame = $turnMaker->makeTurn();

        $newIndustries = array_map ( fn(PlanetSurface $s)=>$s->getIndustry() ,  $newGame->getSurfaces());
        $expectedIndustries = array_map ( fn(PlanetSurface $s)=>$s->getIndustry() ,  $expectedGame->getSurfaces());

        $newPopulations = array_map ( fn(PlanetSurface $s)=>$s->getPopulation() ,  $newGame->getSurfaces());
        $expectedPopulations = array_map ( fn(PlanetSurface $s)=>$s->getPopulation() ,  $expectedGame->getSurfaces());

        $this->assertEquals($expectedIndustries, $newIndustries, 'Industries');
        $this->assertEquals($expectedPopulations, $newPopulations, 'Populations');
    }

    public static function provideTestingGames(): array
    {
        return [
            'test destructions 1' => self::prepareData1(),
        ];
    }

    private static function prepareData1(): array
    {
        return [
            'game' => (new GameTurn())
                ->setFleets([
                        (new Fleet())->addShip(
                            (new Ship())
                                ->setId('ship1')
                                ->setModelName('modelAbc')
                                ->setAttack(2)
                                ->setGuns(1)
                                ->setX(10)
                                ->setY(10)
                                ->setOwner((new Race())->setId('player1'))
                        )
                    ]
                )
                ->setSurfaces([
                    (new PlanetSurface())
                        ->setOwner(
                            (new Race())
                                ->setId('player2')
                                ->setTechnologies(new Technologies())
                        )
                        ->setPopulation(100)
                        ->setIndustry(100)
                        ->setMaterial(0)
                        ->setPlanet(
                            (new Planet())->setLocation((new Location())->setX(10)->setY(10))
                        )
                ])
            // two players
            // one player's fleet over planet of the second player's planet
            // the constructions of the second player may be or may be not accounted
            ,
            'expectedGame' => (new GameTurn())
                ->setSurfaces([
                    (new PlanetSurface())->setOwner(
                        (new Race())->setId('player2')
                    )
                        ->setPopulation(99)
                        ->setIndustry(99)
                        ->setMaterial(0)
                        ->setPlanet(
                            (new Planet())->setLocation((new Location())->setX(10)->setY(10))
                        )
                ]),
        ];
    }
}