<?php

namespace Galaktika\V2\Build;

use Galaktika\Util\Math;
use Galaktika\V2\Data\MarkedLocation;
use Galaktika\V2\Data\Planet;
use Galaktika\V2\Data\PlanetSurface;
use Galaktika\V2\Data\Race;
use Galaktika\V2\Data\Universe;
use Galaktika\V2\Space\SectorsMap;

class UniverseBuilder
{

//    private SectorsMap $sectorsMap;
    private Universe $universe;

    /** @var Race[] */
    private array $races;

    private float $size;


    /**
     * @param float $minDistance
     * @param float $minPlayersDistance
     * @param float $size
     */
    public function __construct(float $size )
    {
        $this->size = $size;
    }

    public function buildUniverse(array $races, float $minPlayersDistance, float $size, int $planetsCount): Universe
    {
        $this->races = $races;

        $this->universe = new Universe();
        $this->universe->setSize($size);

        $this->createPlayersPlanets($minPlayersDistance, $planetsCount);

        return $this->universe;
    }


    private function createPlayersPlanets(float $distance, int $planetsCount): void
    {
        // randomly generate coordinates
        /** @var MarkedLocation[] $allLocations */
        $allLocations = [];
        for ($k = 0; $k < $planetsCount; $k++) {
            // TODO use random generator class/interface?
            $x = lcg_value() * $this->universe->getSize();
            $y = lcg_value() * $this->universe->getSize();

            $location = new MarkedLocation($x, $y);

            $allLocations[] = $location;
        }

        $this->disableByDistance($allLocations, $distance);

        $planets = [];
        $surfaces = [];

        $ri = 0;

        foreach ($allLocations as $location) {
            if ( ! $location->isEnabled() ) {
                continue;
            }

            $planet = (new Planet()) -> setLocation( $location->getLocation());
            $planets[] = $planet;

            if ( $ri >= count($this->races)) {
                continue;
            }
            $planetSurface = new PlanetSurface();
            $planetSurface->setPlanet($planet);
            $planetSurface->setOwner($this->races[$ri++]);

            $surfaces[] = $planetSurface;
        }

        $this->universe->setPlanets($planets);
        $this->universe->setPlanetSurfaces($surfaces);
    }

    /**
     * @param MarkedLocation[] $locations
     * @param float $minDistance
     * @return int
     */
    public function disableByDistance(array $locations, float $minDistance) : int {
        $sectorsMap = new SectorsMap($this->size, $minDistance);

        foreach ($locations as $l) {
            $sectorsMap->addObject($l->getX(), $l->getY(), $l);
        }

        $squareMinDistance = Math::square($minDistance);
        $disabledCount = 0;
        foreach ($locations as $l ) {
            if (!$l->isEnabled()) {
                continue;
            }

            /** @var MarkedLocation[] $nearbyLocations */
            $nearbyLocations = $sectorsMap->getNearbyObjects($l->getX(), $l->getY(), 1);

            foreach ($nearbyLocations as $nearbyLocation) {
                if ( $nearbyLocation === $l ) {
                    continue;
                }

                if ( $l->squareDistance($nearbyLocation) < $squareMinDistance ) {
                    $nearbyLocation->setEnabled(false);
                    $disabledCount ++;
                }
            }
        }

        return $disabledCount;
    }


}