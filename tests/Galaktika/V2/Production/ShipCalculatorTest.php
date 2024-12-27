<?php

namespace Tests\Galaktika\V2\Production;

use Galaktika\V2\Data\Ship;
use Galaktika\V2\Data\Technologies;
use Galaktika\V2\Production\ShipCalculator;
use Galaktika\V2\Production\ShipModel;
use PHPUnit\Framework\TestCase;

class ShipCalculatorTest extends TestCase
{

    /**
     * @dataProvider provide
     */
    public function testCalculateShip(ShipModel $shipModel, Technologies $technologies, Ship $expectedShip)
    {
        $ship = ShipCalculator::calculate($shipModel, $technologies);
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
                    ->setAttackMass(1)
                    ->setDefenceMass(1)
                    ->setEngineMass(1)
                    ->setCargoMass(1),
                'technologies' => new Technologies(),
                'expectedShip' => (new Ship())
                    ->setMass(4)
                    ->setGuns(1)
                    ->setAttack(1)
                    ->setDefence(0.5)
                    ->setSpeed(0.25)
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
            'test perf' => [
                'shipModel' => (new ShipModel())
                    ->setId(uniqid())
                    ->setName('perf')
                    ->setGuns(20)
                    ->setAttackMass(1)
                    ->setDefenceMass(40)
                    ->setEngineMass(20)
                    ->setCargoMass(0),
                'technologies' => new Technologies(),
                'expectedShip' => (new Ship())
                    ->setMass(80)
                    ->setGuns(20)
                    ->setAttack(1)
                    ->setDefence(4.47213595499958)
                    ->setSpeed(0.25)
                    ->setMaxCargo(0),
            ],
            'test perf2' => [
                'shipModel' => (new ShipModel())
                    ->setId(uniqid())
                    ->setName('perf')
                    ->setGuns(35)
                    ->setAttackMass(1)
                    ->setDefenceMass(40)
                    ->setEngineMass(25)
                    ->setCargoMass(0),
                'technologies' => new Technologies(),
                'expectedShip' => (new Ship())
                    ->setMass(100)
                    ->setGuns(35)
                    ->setAttack(1)
                    ->setDefence(4)
                    ->setSpeed(0.25)
                    ->setMaxCargo(0),
            ],
            'test hitter' => [
                'shipModel' => (new ShipModel())
                    ->setId(uniqid())
                    ->setName('hitter')
                    ->setGuns(1)
                    ->setAttackMass(35)
                    ->setDefenceMass(40)
                    ->setEngineMass(25)
                    ->setCargoMass(0),
                'technologies' => new Technologies(),
                'expectedShip' => (new Ship())
                    ->setMass(100)
                    ->setGuns(1)
                    ->setAttack(35)
                    ->setDefence(4)
                    ->setSpeed(0.25)
                    ->setMaxCargo(0),
            ],
            'test tank' => [
                'shipModel' => (new ShipModel())
                    ->setId(uniqid())
                    ->setName('tank')
                    ->setGuns(1)
                    ->setAttackMass(5)
                    ->setDefenceMass(70)
                    ->setEngineMass(25)
                    ->setCargoMass(0),
                'technologies' => new Technologies(),
                'expectedShip' => (new Ship())
                    ->setMass(100)
                    ->setGuns(1)
                    ->setAttack(5)
                    ->setDefence(7)
                    ->setSpeed(0.25)
                    ->setMaxCargo(0),
            ],
            'test stronghold' => [
                'shipModel' => (new ShipModel())
                    ->setId(uniqid())
                    ->setName('stronghold')
                    ->setGuns(1)
                    ->setAttackMass(5)
                    ->setDefenceMass(95)
                    ->setEngineMass(0)
                    ->setCargoMass(0),
                'technologies' => new Technologies(),
                'expectedShip' => (new Ship())
                    ->setMass(100)
                    ->setGuns(1)
                    ->setAttack(5)
                    ->setDefence(9.5)
                    ->setSpeed(0)
                    ->setMaxCargo(0),
            ],
        ];
    }

}