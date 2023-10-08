<?php

namespace Tests\Galaktika\V2\Production;

use Galaktika\V2\Data\Ship;
use Galaktika\V2\Data\Technologies;
use Galaktika\V2\Production\ShipCalculator2;
use Galaktika\V2\Production\ShipModel;
use PHPUnit\Framework\TestCase;

class ShipCalculator2Test extends TestCase
{

    /**
     * @dataProvider provide
     */
    public function testCalculateShip(ShipModel $shipModel, Technologies $technologies, Ship $expectedShip)
    {
        $ship = ShipCalculator2::calculate($shipModel, $technologies);
        $this->assertEquals($expectedShip->getMass(), $ship->getMass());
        $this->assertEquals($expectedShip->getAttack(), $ship->getAttack());
        $this->assertEquals($expectedShip->getGuns(), $ship->getGuns());
        $this->assertEquals($expectedShip->getDefence(), $ship->getDefence());
        $this->assertEquals($expectedShip->getMaxCargo(), $ship->getMaxCargo());
        $this->assertEquals($expectedShip->getSpeed(), $ship->getSpeed());
    }

    public function provide(): array
    {
        return [
            'test1' => [
                'shipModel' => (new ShipModel())
                    ->setId(uniqid())
                    ->setName('modelX')
                    ->setGuns(1)
                    ->setAttackMass(2)
                    ->setDefenceMass(1)
                    ->setEngineMass(1)
                    ->setCargoMass(1),
                'technologies' => new Technologies(),
                'expectedShip' => (new Ship())
                    ->setMass(5)
                    ->setGuns(1)
                    ->setAttack(2)
                    ->setDefence(0.5)
                    ->setSpeed(0.2)
                    ->setMaxCargo(1),
            ],
            'test drone' => [
                'shipModel' => (new ShipModel())
                    ->setId(uniqid())
                    ->setName('drone')
                    ->setGuns(0)
                    ->setAttackMass(0)
                    ->setDefenceMass(0)
                    ->setEngineMass(1)
                    ->setCargoMass(0),
                'technologies' => new Technologies(),
                'expectedShip' => (new Ship())
                    ->setMass(1)
                    ->setGuns(0)
                    ->setAttack(0)
                    ->setDefence(0)
                    ->setSpeed(1)
                    ->setMaxCargo(0),
            ],

            'test perf2' => [
                'shipModel' => (new ShipModel())
                    ->setId(uniqid())
                    ->setName('perf')
                    ->setGuns(39)
                    ->setAttackMass(1)
                    ->setDefenceMass(36)
                    ->setEngineMass(25)
                    ->setCargoMass(0),
                'technologies' => new Technologies(),
                'expectedShip' => (new Ship())
                    ->setMass(100)
                    ->setGuns(39)
                    ->setAttack(1)
                    ->setDefence(4.5)
                    ->setSpeed(0.25)
                    ->setMaxCargo(0),
            ],

            'test hitter' => [
                'shipModel' => (new ShipModel())
                    ->setId(uniqid())
                    ->setName('hitter')
                    ->setGuns(1)
                    ->setAttackMass(39)
                    ->setDefenceMass(36)
                    ->setEngineMass(25)
                    ->setCargoMass(0),
                'technologies' => new Technologies(),
                'expectedShip' => (new Ship())
                    ->setMass(100)
                    ->setGuns(1)
                    ->setAttack(39)
                    ->setDefence(4.5)
                    ->setSpeed(0.25)
                    ->setMaxCargo(0),
            ],
            'test tank' => [
                'shipModel' => (new ShipModel())
                    ->setId(uniqid())
                    ->setName('tank')
                    ->setGuns(1)
                    ->setAttackMass(5)
                    ->setDefenceMass(75)
                    ->setEngineMass(20)
                    ->setCargoMass(0),
                'technologies' => new Technologies(),
                'expectedShip' => (new Ship())
                    ->setMass(100)
                    ->setGuns(1)
                    ->setAttack(5)
                    ->setDefence(15)
                    ->setSpeed(0.2)
                    ->setMaxCargo(0),
            ],

            'test stronghold' => [
                'shipModel' => (new ShipModel())
                    ->setId(uniqid())
                    ->setName('stronghold')
                    ->setGuns(1)
                    ->setAttackMass(4)
                    ->setDefenceMass(96)
                    ->setEngineMass(0)
                    ->setCargoMass(0),
                'technologies' => new Technologies(),
                'expectedShip' => (new Ship())
                    ->setMass(100)
                    ->setGuns(1)
                    ->setAttack(4)
                    ->setDefence(48)
                    ->setSpeed(0)
                    ->setMaxCargo(0),
            ],
            'test bunker' => [
                'shipModel' => (new ShipModel())
                    ->setId(uniqid())
                    ->setName('bunker')
                    ->setGuns(0)
                    ->setAttackMass(0)
                    ->setDefenceMass(96)
                    ->setEngineMass(0)
                    ->setCargoMass(4),
                'technologies' => new Technologies(),
                'expectedShip' => (new Ship())
                    ->setMass(100)
                    ->setGuns(0)
                    ->setAttack(0)
                    ->setDefence(48)
                    ->setSpeed(0)
                    ->setMaxCargo(4),
            ],
            'test carrier' => [
                'shipModel' => (new ShipModel())
                    ->setId(uniqid())
                    ->setName('carrier')
                    ->setGuns(1)
                    ->setAttackMass(1)
                    ->setDefenceMass(36)
                    ->setEngineMass(25)
                    ->setCargoMass(38),
                'technologies' => new Technologies(),
                'expectedShip' => (new Ship())
                    ->setMass(100)
                    ->setGuns(1)
                    ->setAttack(1)
                    ->setDefence(4.5)
                    ->setSpeed(0.25)
                    ->setMaxCargo(38),
            ],

            'test perfodrone' => [
                'shipModel' => (new ShipModel())
                    ->setId(uniqid())
                    ->setName('perfodrone')
                    ->setGuns(1)
                    ->setAttackMass(1)
                    ->setDefenceMass(0)
                    ->setEngineMass(1)
                    ->setCargoMass(0),
                'technologies' => new Technologies(),
                'expectedShip' => (new Ship())
                    ->setMass(2)
                    ->setGuns(1)
                    ->setAttack(1)
                    ->setDefence(0)
                    ->setSpeed(0.5)
                    ->setMaxCargo(0),
            ],
            'test orb perfodrone' => [
                'shipModel' => (new ShipModel())
                    ->setId(uniqid())
                    ->setName('orb perfodrone')
                    ->setGuns(1)
                    ->setAttackMass(1)
                    ->setDefenceMass(0)
                    ->setEngineMass(0)
                    ->setCargoMass(0),
                'technologies' => new Technologies(),
                'expectedShip' => (new Ship())
                    ->setMass(1)
                    ->setGuns(1)
                    ->setAttack(1)
                    ->setDefence(0)
                    ->setSpeed(0)
                    ->setMaxCargo(0),
            ],
        ];
    }
}