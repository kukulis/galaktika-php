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
    public function testCalculateShip(ShipModel $shipModel, Technologies $technologies, Ship $expectedShip) {
        $ship = ShipCalculator::calculate($shipModel, $technologies);
        $this->assertEquals($expectedShip->getMass(), $ship->getMass());
        $this->assertEquals($expectedShip->getAttack(), $ship->getAttack());
        $this->assertEquals($expectedShip->getGuns(), $ship->getGuns());
        $this->assertEquals($expectedShip->getDefence(), $ship->getDefence());
        $this->assertEquals($expectedShip->getMaxCargo(), $ship->getMaxCargo());
        $this->assertEquals($expectedShip->getSpeed(), $ship->getSpeed());

    }

    public function provide() : array {
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
                    ->setMaxCargo(1)
            ]
        ];
    }

}