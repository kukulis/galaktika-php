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

        $location = $fleet->getLocation()??new Location();
        $newLocation = new Location();
        $newLocation->setX($location->getX() + $xSpeed );
        $newLocation->setY($location->getY() + $ySpeed );
        $fleetResult->setLocation($newLocation);

        return $fleetResult;
    }
}