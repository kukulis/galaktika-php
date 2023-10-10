<?php

namespace Tests\Galaktika\V2\Production;

use Galaktika\V2\Data\PlanetSurface;
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
        int $expectedMadeAmount
    ) {
        $rezPlanetSurface = $shipCommand->execute($planetSurface);

        $this->assertEquals($expectedPlanetSurface->getUsedPopulation(), $rezPlanetSurface->getUsedPopulation());
        $this->assertEquals($expectedPlanetSurface->getUsedIndustry(), $rezPlanetSurface->getUsedIndustry());
        $this->assertEquals($expectedPlanetSurface->getMaterial(), $rezPlanetSurface->getMaterial());

        $this->assertEquals($expectedMadeAmount, $shipCommand->getMadeAmount());
    }

    public function provide(): array
    {
        return [
            'test1' => [
                'shipCommand' =>
                    (new ShipCommand())
                        ->setModelToBuild(
                            (new ShipModel())
                                ->setId(uniqid())
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
            ],

            // TODO more tests
        ];
    }

}