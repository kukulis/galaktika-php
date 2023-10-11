<?php

namespace Galaktika\V2\Build;

use Galaktika\V2\Data\Universe;
use Galaktika\V2\Space\Sector;

class UniverseBuilder
{

    public static function buildUniverse(array $races, float $minDistance, float $size, int $planetsCount) : Universe {
        $universe = new Universe();

        $sectorSize = $minDistance * 3;
        $universe->setSectorSize($sectorSize);

        self::makeSectors($universe);

        return $universe;
    }

    public static function makeSectors(Universe $universe) : array {
        $sectorSize = $universe->getSectorSize();

        $sectorCountD1 = $universe->getSectorSize() / $sectorSize;

        for($x=0; $x < $sectorCountD1; $x++) {
            for($y=0; $y < $sectorCountD1; $y++) {
                $sector = new Sector();
                $sector->setSectorX($x * $sectorSize);
                $sector->setSectorX($y * $sectorSize);
            }
        }

    }

    public static function createPlayersPlanets(Universe $universe) : void {
        // TODO

        $sectors = self::makeSectors($universe);
        $sectorsArray = [];
        // TODO build sectors array

        // randomly generate coordinates
        // calculate sector
        // search planets in this and in neighbour sectors.
        // if too near generate coordinates again
        // if ok put in to universe and in to sectors arrays

    }
}