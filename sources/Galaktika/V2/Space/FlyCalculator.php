<?php

namespace Galaktika\V2\Space;

use Galaktika\V2\Data\Fleet;
use Galaktika\V2\Data\Location;

class FlyCalculator
{
    public static function flyFleet(Fleet $fleet): Fleet
    {
        $speed = $fleet->calculateSpeed();

        // TODO add new ids
        $fleetResult = clone $fleet;

        // may need to check target location
        if ( $fleet->getTargetLocation() != null ) {
            $distance = $fleet->getLocation()->distance($fleet->getTargetLocation());

            if ($distance < $speed) {
                $fleetResult->setLocation($fleet->getTargetLocation()); // clone target location ??

                return $fleetResult;
            }
        }

        $xSpeed = cos($fleet->getDirection()) * $speed;
        $ySpeed = sin($fleet->getDirection()) * $speed;

        $location = $fleet->getLocation() ?? new Location(); // XXX dont like this '??'
        $newLocation = new Location();
        $newLocation->setX($location->getX() + $xSpeed);
        $newLocation->setY($location->getY() + $ySpeed);
        $fleetResult->setLocation($newLocation);

        return $fleetResult;
    }

    public static function calculateDirection(Location $source, Location $destination): float
    {
        $deltaX = $destination->getX() - $source->getX();
        $deltaY = $destination->getY() - $source->getY();
        $distance = $source->getDistance($destination);
        if ($distance == 0) {
            // decide if we need to throw exception
            return 0;
        }

        $sin = abs($deltaY) / $distance;

        $direction = asin($sin);

        if ($deltaX >= 0 && $deltaY >= 0) {
            return $direction;
        }

        if ($deltaX < 0 && $deltaY >= 0) {
            return pi() - $direction;
        }

        if ($deltaX >= 0 && $deltaY < 0) {
            return -$direction;
        }

        if ($deltaX < 0 && $deltaY < 0) {
            return pi() + $direction;
        }

        // should net be reached
        // decide if we need to throw exception
        return 0;
    }
}