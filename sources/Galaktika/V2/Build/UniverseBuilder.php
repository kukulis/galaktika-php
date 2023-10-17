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

    // TODO calculate depending on players radius and simple radius formula
    private const SECTOR_RADIUS = 1;

    private SectorsMap $sectorsMap;
    private Universe $universe;

    /** @var Race[] */
    private array $races;

    private int $planetsCount;
    private float $size;


    /**
     * @param float $minDistance
     * @param float $minPlayersDistance
     * @param float $size
     */
    public function __construct(float $size )
    {
        $this->size = $size;
        // TODO validate repeatedness
    }

    public function buildUniverse(array $races, float $minDistance, float $minPlayersDistance, float $size, int $planetsCount): Universe
    {
        $this->races = $races;
        $this->planetsCount = $planetsCount;

        $this->universe = new Universe();
        $this->universe->setSize($size);

        $sectorSize = $minDistance * 3;
        $this->sectorsMap = new SectorsMap($size, $sectorSize);

        $this->createPlayersPlanets($minPlayersDistance);

        return $this->universe;
    }


    private function createPlayersPlanets(float $distance): void
    {
        // TODO use local sectors map?
        $generatedLocationsCount = count($this->races) * 5;

        // randomly generate coordinates
        /** @var MarkedLocation[] $allLocations */
        $allLocations = [];
        for ($k = 0; $k < $generatedLocationsCount; $k++) {
            // TODO use random generator class/interface?
            $x = lcg_value() * $this->universe->getSize();
            $y = lcg_value() * $this->universe->getSize();

            $location = new MarkedLocation($x, $y);

            // TODO remove sectors map from here
            $this->sectorsMap->addObject($x, $y, $location);
            $allLocations[] = $location;
        }

        // remove coordinates that are too near to others
        $givenSquareDistance = $distance * $distance;

        foreach ($allLocations as $location) {
            if (!$location->isEnabled()) {
                continue;
            }

            /** @var MarkedLocation[] $neighbourLocations */
            $neighbourLocations = $this->sectorsMap->getNearbyObjects($location->getX(), $location->getY(), self::SECTOR_RADIUS);

            foreach ($neighbourLocations as $neighbourLocation) {
                // may be better to check identificators
                if ( $neighbourLocation === $location ) {
                    continue;
                }

                if (!$neighbourLocation->isEnabled()) {
                    continue;
                }

                $squareDistance = Math::square( $neighbourLocation->getX()) + Math::square( $neighbourLocation->getY());
                if ( $squareDistance < $givenSquareDistance) {
                    $neighbourLocation->setEnabled(false);
                }
            }
        }

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
     * // TODO cover with test
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