<?php

namespace Galaktika\Action;

use Galaktika\Data\Fleet;
use Galaktika\Util\Grouper;

class FleetsGrouper
{
    /**
     * @param Fleet[] $fleets
     * @return Fleet[][]
     */
    public static function groupFleets(array $fleets): array
    {
        return Grouper::group($fleets, fn(Fleet $fleet) => $fleet->getCurrentLocation()->getKey());
    }
}