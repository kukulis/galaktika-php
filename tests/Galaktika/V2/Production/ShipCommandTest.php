<?php

namespace Tests\Galaktika\V2\Production;

use Galaktika\V2\Data\PlanetSurface;
use Galaktika\V2\Data\Race;
use Galaktika\V2\Data\Ship;
use Galaktika\V2\Data\Technologies;
use Galaktika\V2\Data\UnfinishedShip;
use Galaktika\V2\Production\ShipCommand;
use Galaktika\V2\Production\ShipModel;
use PHPUnit\Framework\TestCase;

class ShipCommandTest extends TestCase
{
    /**
     * @dataProvider provide
     */
    public function testShipCommand(
        ShipCommand $shipCommand,
        PlanetSurface $planetSurface,
        PlanetSurface $expectedPlanetSurface,
        int $expectedMadeAmount,
        ?UnfinishedShip $expectedUnfinishedShip
    ) {
        $rezPlanetSurface = $shipCommand->execute($planetSurface);

        $this->assertEquals($expectedPlanetSurface->getUsedPopulation(), $rezPlanetSurface->getUsedPopulation());
        $this->assertEquals($expectedPlanetSurface->getUsedIndustry(), $rezPlanetSurface->getUsedIndustry());
        $this->assertEquals($expectedPlanetSurface->getMaterial(), $rezPlanetSurface->getMaterial());

        $this->assertEquals($expectedMadeAmount, $shipCommand->getMadeAmount());
        $unfinishedShip = $rezPlanetSurface->findUnfinishedShipByModelId($shipCommand->getModelToBuild()->getId());

        $this->assertEquals(is_null($expectedUnfinishedShip), is_null($unfinishedShip));

        if (!is_null($expectedUnfinishedShip)) {
            $this->assertEquals($expectedUnfinishedShip->getResourcesUsed(), $unfinishedShip->getResourcesUsed());
        }
    }

    public function provide(): array
    {
        return [
            'test1' => [
                'shipCommand' =>
                    (new ShipCommand())
                        ->setModelToBuild(
                            (new ShipModel())
                                ->setId('modelid')
                                ->setName('test model')
                                ->setEngineMass(1)
                        )
                        ->setTargetAmount(1)
                ,
                'planetSurface' =>
                    (new PlanetSurface())
                        ->setPopulation(1)
                        ->setIndustry(1)
                        ->setMaterial(1)
                ,
                'expectedPlanetSurface' =>
                    (new PlanetSurface())
                        ->setPopulation(1)
                        ->setIndustry(1)
                        ->setMaterial(0)
                        ->setUsedIndustry(1)
                        ->setUsedPopulation(1)
                ,
                'expectedMadeAmount' => 1,
                'expectedUnfinishedShip' => null,
            ],
            'test small unfinished' => [
                'shipCommand' =>
                    (new ShipCommand())
                        ->setModelToBuild(
                            (new ShipModel())
                                ->setId('testmodel')
                                ->setName('test model')
                                ->setEngineMass(2)
                        )
                        ->setTargetAmount(1)
                ,
                'planetSurface' =>
                    (new PlanetSurface())
                        ->setPopulation(1)
                        ->setIndustry(1)
                        ->setMaterial(1)
                        ->setOwner((new Race())->setTechnologies(new Technologies()))
                ,
                'expectedPlanetSurface' =>
                    (new PlanetSurface())
                        ->setPopulation(1)
                        ->setIndustry(1)
                        ->setMaterial(0)
                        ->setUsedIndustry(1)
                        ->setUsedPopulation(1)
                ,
                'expectedMadeAmount' => 0,
                'expectedUnfinishedShip' =>
                    (new UnfinishedShip())->setShip(
                        (new Ship())->setModelId('testmodel')
                    )
                        ->setResourcesUsed(1)
                ,
            ],
            // TODO more tests
            // with higher target amount
            // with partial target amount
            // with big ship
        ];
    }

}