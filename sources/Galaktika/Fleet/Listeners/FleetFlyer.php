<?php

namespace Galaktika\Fleet\Listeners;

use Galaktika\Events\FleetTurnEvent;

class FleetFlyer
{
    public const TURN_TIME = 400;

    public function call(FleetTurnEvent $event) {
        $currentLocation = $event->getFleet()->getCurrentLocation();
        $destinationLocation = $event->getFleet()->getDestinationLocation();

        if ( $currentLocation->equals($destinationLocation) ) {
            // do nothing
            return;
        }

        // calculate direction
        $vector = $currentLocation->vector($destinationLocation);
        // calculate distance
        $distance = $vector->length();
        // calculate speed
        $speed = $event->getFleet()->getMinimalSpeed();
        $maxFlyDistance = $speed * self::TURN_TIME;
        // find if the destination reached
        if ( $distance < $maxFlyDistance) {
            $newLocation = clone $destinationLocation;
        }
        else {
            $newLocation = $vector->withLength($maxFlyDistance)->newLocation( $currentLocation);
        }

        // assign new Location to the fleet
        $event->getNewFleet()->setCurrentLocation($newLocation);
    }
}