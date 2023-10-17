<?php

namespace Galaktika\V2\Data;

use Galaktika\Util\Math;

trait DistanceTrait
{
    public function distance(ILocation $location): float
    {
        return sqrt($this->squareDistance($location));
    }

    public function squareDistance(ILocation $location): float
    {
        return Math::square($this->x - $location->getX()) + Math::square($this->y - $location->getY());
    }
}