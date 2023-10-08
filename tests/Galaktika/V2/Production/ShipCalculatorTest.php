<?php

namespace Tests\Galaktika\V2\Production;

use Galaktika\V2\Data\Technologies;
use Galaktika\V2\Production\ShipCalculator;
use Galaktika\V2\Production\ShipModel;
use PHPUnit\Framework\TestCase;

class ShipCalculatorTest extends TestCase
{

    public function testCalculateShip() {
        $shipModel = new ShipModel();
        $technologies = new Technologies();

        $shipModel
            ->setId(uniqid())
            ->setName('modelX')
            ->setGuns(1)
            ->setAttackMass(1)
            ->setDefenceMass(1)
            ->setEngineMass(1)
            ->setCargoMass(1);

        $ship = ShipCalculator::calculate($shipModel, $technologies);
        $this->assertEquals(4, $ship->getMass());
        $this->assertEquals(1, $ship->getAttack());
        $this->assertEquals(1, $ship->getGuns());
        $this->assertEquals(0.5, $ship->getDefence());
        $this->assertEquals(1, $ship->getMaxCargo());
        $this->assertEquals(0.25, $ship->getSpeed());

    }

}