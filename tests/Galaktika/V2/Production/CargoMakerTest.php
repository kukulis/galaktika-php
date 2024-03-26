<?php

namespace Tests\Galaktika\V2\Production;

use Galaktika\V2\Data\Planet;
use Galaktika\V2\Data\PlanetSurface;
use Galaktika\V2\Data\Ship;
use Galaktika\V2\Data\ShipCargo;
use Galaktika\V2\Space\CargoMaker;
use PHPUnit\Framework\TestCase;

class CargoMakerTest extends TestCase
{
    /**
     * @dataProvider providePopulationLoadData
     */
    public function testLoadPopulation(
        PlanetSurface $surface,
        float $amount,
        ShipCargo $shipCargo,
        float $expectedLoadAmount,
        float $expectedPopulation,
        ShipCargo $expectedCargo
    ) {
        $cargoMaker = new CargoMaker();
        $loadAmount = $cargoMaker->loadPopulation($surface, $amount, $shipCargo);
        $this->assertEquals($expectedLoadAmount, $loadAmount);

        $this->assertEquals($expectedPopulation, $surface->getPopulation());
        $this->assertEquals($expectedCargo->getPopulation(), $shipCargo->getPopulation());
        $this->assertEquals($expectedCargo->getMaterial(), $shipCargo->getMaterial());
        $this->assertEquals($expectedCargo->getFreeSpace(), $shipCargo->getFreeSpace());
        $this->assertEquals($expectedCargo->getShip()->getId(), $shipCargo->getShip()->getId());
    }

    public static function providePopulationLoadData(): array
    {
        return [
            'test1' => [
                'surface' => (new PlanetSurface())
                    ->setPlanet((new Planet())->setSize(100))
                    ->setPopulation(100),
                'amount' => 10,
                'shipCargo' => (new ShipCargo())
                    ->setShip((new Ship())->setId('ship1')->setMaxCargo(10))
                    ->setPopulation(0),
                'expectedLoadAmount' => 10,
                'expectedPopulation' => 90,
                'expectedCargo' => (new ShipCargo())
                    ->setShip((new Ship())->setId('ship1')->setMaxCargo(10))
                    ->setPopulation(10),
            ]
        ];
    }

}