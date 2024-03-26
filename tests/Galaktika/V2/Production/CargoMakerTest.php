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
            ],
            'test2' => [
                'surface' => (new PlanetSurface())
                    ->setPlanet((new Planet())->setSize(100))
                    ->setPopulation(100),
                'amount' => 10,
                'shipCargo' => (new ShipCargo())
                    ->setShip((new Ship())->setId('ship1')->setMaxCargo(10))
                    ->setPopulation(6),
                'expectedLoadAmount' => 4,
                'expectedPopulation' => 96,
                'expectedCargo' => (new ShipCargo())
                    ->setShip((new Ship())->setId('ship1')->setMaxCargo(10))
                    ->setPopulation(10),
            ],
            'test3' => [
                'surface' => (new PlanetSurface())
                    ->setPlanet((new Planet())->setSize(100))
                    ->setPopulation(5),
                'amount' => 10,
                'shipCargo' => (new ShipCargo())
                    ->setShip((new Ship())->setId('ship1')->setMaxCargo(10))
                    ->setPopulation(0),
                'expectedLoadAmount' => 5,
                'expectedPopulation' => 0,
                'expectedCargo' => (new ShipCargo())
                    ->setShip((new Ship())->setId('ship1')->setMaxCargo(10))
                    ->setPopulation(5),
            ],
        ];
    }

    /**
     * @dataProvider providePopulationUnloadData
     */
    public function testUnloadPopulation(
        PlanetSurface $surface,
        float $amount,
        ShipCargo $shipCargo,
        float $expectedUnloadAmount,
        float $expectedPopulation,
        ShipCargo $expectedCargo
    ) {
        $cargoMaker = new CargoMaker();
        $unloadAmount = $cargoMaker->unloadPopulation($surface, $amount, $shipCargo);
        $this->assertEquals($expectedUnloadAmount, $unloadAmount);

        $this->assertEquals($expectedPopulation, $surface->getPopulation());
        $this->assertEquals($expectedCargo->getPopulation(), $shipCargo->getPopulation());
        $this->assertEquals($expectedCargo->getMaterial(), $shipCargo->getMaterial());
        $this->assertEquals($expectedCargo->getFreeSpace(), $shipCargo->getFreeSpace());
        $this->assertEquals($expectedCargo->getShip()->getId(), $shipCargo->getShip()->getId());
    }

    public static function providePopulationUnloadData(): array
    {
        return [
            'test unload 1' => [
                'surface' => (new PlanetSurface())
                    ->setPlanet((new Planet())->setSize(100))
                    ->setPopulation(50),
                'amount' => 10,
                'shipCargo' => (new ShipCargo())
                    ->setShip((new Ship())->setId('ship1')->setMaxCargo(10))
                    ->setPopulation(10),
                'expectedUnloadAmount' => 10,
                'expectedPopulation' => 60,
                'expectedCargo' => (new ShipCargo())
                    ->setShip((new Ship())->setId('ship1')->setMaxCargo(10))
                    ->setPopulation(0),
            ]
        ];
    }

    /**
     * @dataProvider provideMaterialsLoadData
     */
    public function testLoadMaterials(
        PlanetSurface $surface,
        float $amount,
        ShipCargo $shipCargo,
        float $expectedLoadAmount,
        float $expectedMaterials,
        ShipCargo $expectedCargo
    ) {
        $cargoMaker = new CargoMaker();
        $loadAmount = $cargoMaker->loadMaterials($surface, $amount, $shipCargo);
        $this->assertEquals($expectedLoadAmount, $loadAmount);

        $this->assertEquals($expectedMaterials, $surface->getMaterial());
        $this->assertEquals($expectedCargo->getPopulation(), $shipCargo->getPopulation());
        $this->assertEquals($expectedCargo->getMaterial(), $shipCargo->getMaterial());
        $this->assertEquals($expectedCargo->getFreeSpace(), $shipCargo->getFreeSpace());
        $this->assertEquals($expectedCargo->getShip()->getId(), $shipCargo->getShip()->getId());
    }

    public static function provideMaterialsLoadData(): array
    {
        return [
            'test load materials 1' => [
                'surface' => (new PlanetSurface())
                    ->setPlanet((new Planet())->setSize(100))
                    ->setMaterial(50)
                    ->setPopulation(100),
                'amount' => 10,
                'shipCargo' => (new ShipCargo())
                    ->setShip((new Ship())->setId('ship1')->setMaxCargo(10))
                    ->setPopulation(0)
                    ->setMaterial(0),
                'expectedLoadAmount' => 10,
                'expectedMaterials' => 40,
                'expectedCargo' => (new ShipCargo())
                    ->setShip((new Ship())->setId('ship1')->setMaxCargo(10))
                    ->setMaterial(10)
                    ->setPopulation(0),
            ]
        ];
    }


    /**
     * @dataProvider provideMaterialsUnloadData
     */
    public function testUnloadMaterials(
        PlanetSurface $surface,
        float $amount,
        ShipCargo $shipCargo,
        float $expectedUnloadAmount,
        float $expectedMaterials,
        ShipCargo $expectedCargo
    ) {
        $cargoMaker = new CargoMaker();
        $unloadAmount = $cargoMaker->unloadMaterials($surface, $amount, $shipCargo);
        $this->assertEquals($expectedUnloadAmount, $unloadAmount);

        $this->assertEquals($expectedMaterials, $surface->getMaterial());
        $this->assertEquals($expectedCargo->getPopulation(), $shipCargo->getPopulation());
        $this->assertEquals($expectedCargo->getMaterial(), $shipCargo->getMaterial());
        $this->assertEquals($expectedCargo->getFreeSpace(), $shipCargo->getFreeSpace());
        $this->assertEquals($expectedCargo->getShip()->getId(), $shipCargo->getShip()->getId());
    }

    public static function provideMaterialsUnloadData(): array
    {
        return [
            'test unload materials 1' => [
                'surface' => (new PlanetSurface())
                    ->setPlanet((new Planet())->setSize(100))
                    ->setMaterial(50)
                    ->setPopulation(100),
                'amount' => 10,
                'shipCargo' => (new ShipCargo())
                    ->setShip((new Ship())->setId('ship1')->setMaxCargo(10))
                    ->setPopulation(0)
                    ->setMaterial(10),
                'expectedUnloadAmount' => 10,
                'expectedMaterials' => 60,
                'expectedCargo' => (new ShipCargo())
                    ->setShip((new Ship())->setId('ship1')->setMaxCargo(10))
                    ->setMaterial(0)
                    ->setPopulation(0),
            ]
        ];
    }
}