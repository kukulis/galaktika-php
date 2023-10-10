<?php

namespace Tests\Galaktika\V2\Production;

use Galaktika\V2\Data\PlanetSurface;
use Galaktika\V2\Production\ShipCommand;
use Galaktika\V2\Production\ShipModel;
use PHPUnit\Framework\TestCase;

class ShipCommandTest extends TestCase
{
    public function testShipCommand()
    {
        $shipCommand = new ShipCommand();

        $shipModel = (new ShipModel())
            ->setId(uniqid())
            ->setEngineMass(1);

        $shipCommand->setModelToBuild($shipModel);
        $shipCommand->setTargetAmount(1);

        $planetSurface = new PlanetSurface();
        $planetSurface->setMaterial(1);
        $planetSurface->setIndustry(1);
        $planetSurface->setPopulation(1);

        $rezPlanetSurface = $shipCommand->execute($planetSurface);

        $this->assertEquals(1 , $rezPlanetSurface->getUsedPopulation());
        $this->assertEquals(1 , $rezPlanetSurface->getUsedIndustry());
        $this->assertEquals(0 , $rezPlanetSurface->getMaterial());

        $this->assertEquals(1, $shipCommand->getMadeAmount());
    }

}