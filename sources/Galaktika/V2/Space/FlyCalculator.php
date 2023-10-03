<?php

namespace Galaktika\V2\Space;

use Galaktika\V2\Data\Fleet;
use Galaktika\V2\Data\Location;

class FlyCalculator
{
    public static function flyFleet(Fleet $fleet) : Fleet  {
        $speed = $fleet->calculateSpeed();
        $xSpeed = cos($fleet->getDirection()) * $speed;
        $ySpeed = sin($fleet->getDirection()) * $speed;

        $fleetResult = clone $fleet;

        $newLocation = new Location();
        $newLocation->setX($fleet->getLocation()->getX() + $xSpeed );
        $newLocation->setY($fleet->getLocation()->getY() + $ySpeed );
        $fleetResult->setLocation($newLocation);

        return $fleetResult;
    }
}