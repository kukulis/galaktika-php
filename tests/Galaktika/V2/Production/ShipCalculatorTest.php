<?php

namespace Tests\Galaktika\V2\Production;

use Galaktika\V2\Data\Technologies;
use Galaktika\V2\Production\ShipCalculator;
use Galaktika\V2\Production\ShipModel;
use PHPUnit\Framework\TestCase;

class ShipCalculatorTest extends TestCase
{

    public function testCalculateShip() {
        $ship = ShipCalculator::calculate(new ShipModel(), new Technologies());

        // TODO correct test
        $this->assertTrue(false);
    }

}