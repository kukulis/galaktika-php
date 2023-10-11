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
            'test bigger unfinished' => [
                'shipCommand' =>
                    (new ShipCommand())
                        ->setModelToBuild(
                            (new ShipModel())
                                ->setId('testmodel')
                                ->setName('test model')
                                ->setEngineMass(3)
                        )
                        ->setTargetAmount(2)
                ,
                'planetSurface' =>
                    (new PlanetSurface())
                        ->setPopulation(4)
                        ->setIndustry(4)
                        ->setMaterial(4)
                        ->setOwner((new Race())->setTechnologies(new Technologies()))
                        ->addUnfinishedShip(
                            (new UnfinishedShip())
                            ->setShip((new Ship())->setModelId('testmodel'))
                            ->setResourcesUsed(1)
                        )
                ,
                'expectedPlanetSurface' =>
                    (new PlanetSurface())
                        ->setPopulation(4)
                        ->setIndustry(4)
                        ->setMaterial(0)
                        ->setUsedIndustry(4)
                        ->setUsedPopulation(4)
                ,
                'expectedMadeAmount' => 1,
                'expectedUnfinishedShip' =>
                    (new UnfinishedShip())
                        ->setShip(
                            (new Ship())->setModelId('testmodel')
                        )
                        ->setResourcesUsed(2)
                ,
            ],
            'test huge unfinished' => [
                'shipCommand' =>
                    (new ShipCommand())
                        ->setModelToBuild(
                            (new ShipModel())
                                ->setId('testmodel')
                                ->setName('test model')
                                ->setEngineMass(0)
                                ->setGuns(1)
                                ->setAttackMass(1)
                                ->setDefenceMass(399)
                        )
                        ->setTargetAmount(1)
                ,
                'planetSurface' =>
                    (new PlanetSurface())
                        ->setPopulation(100)
                        ->setIndustry(100)
                        ->setMaterial(100)
                        ->setOwner((new Race())->setTechnologies(new Technologies()))
                        ->addUnfinishedShip(
                            (new UnfinishedShip())
                                ->setShip((new Ship())->setModelId('testmodel'))
                                ->setResourcesUsed(50)
                        )
                ,
                'expectedPlanetSurface' =>
                    (new PlanetSurface())
                        ->setPopulation(100)
                        ->setIndustry(100)
                        ->setMaterial(0)
                        ->setUsedIndustry(100)
                        ->setUsedPopulation(100)
                ,
                'expectedMadeAmount' => 0,
                'expectedUnfinishedShip' =>
                    (new UnfinishedShip())
                        ->setShip(
                            (new Ship())->setModelId('testmodel')
                        )
                        ->setResourcesUsed(150)
                ,
            ],
            'test huge finished' => [
                'shipCommand' =>
                    (new ShipCommand())
                        ->setModelToBuild(
                            (new ShipModel())
                                ->setId('testmodel')
                                ->setName('test model')
                                ->setEngineMass(0)
                                ->setGuns(1)
                                ->setAttackMass(1)
                                ->setDefenceMass(399)
                        )
                        ->setTargetAmount(1)
                ,
                'planetSurface' =>
                    (new PlanetSurface())
                        ->setPopulation(100)
                        ->setIndustry(100)
                        ->setMaterial(60)
                        ->setOwner((new Race())->setTechnologies(new Technologies()))
                        ->addUnfinishedShip(
                            (new UnfinishedShip())
                                ->setId(uniqid())
                                ->setShip((new Ship())->setModelId('testmodel'))
                                ->setResourcesUsed(350)
                        )
                ,
                'expectedPlanetSurface' =>
                    (new PlanetSurface())
                        ->setPopulation(100)
                        ->setIndustry(100)
                        ->setMaterial(10)
                        ->setUsedIndustry(50)
                        ->setUsedPopulation(50)
                ,
                'expectedMadeAmount' => 1,
                'expectedUnfinishedShip' => null,
            ],
        ];
    }

}