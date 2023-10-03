<?php

namespace Galaktika\V2\Production;

use Galaktika\V2\Data\Ship;
use Galaktika\V2\Data\Technologies;

class ShipCalculator
{
    public static function calculate(ShipModel $shipModel, Technologies $techologies) : Ship {
        return new Ship();
    }
}