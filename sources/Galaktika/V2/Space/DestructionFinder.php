<?php

namespace Galaktika\V2\Space;

use Galaktika\Util\Grouper;
use Galaktika\V2\Battle\Destruction;
use Galaktika\V2\Data\IDiplomacyMap;
use Galaktika\V2\Data\PlanetSurface;
use Galaktika\V2\Data\Ship;

class DestructionFinder
{
    /**
     * @param Ship[] $ships
     * @param PlanetSurface[] $surfaces
     * @return Destruction[]
     */
    public static function findDesctructions(array $ships, array $surfaces, IDiplomacyMap $diplomacyMap): array
    {
        /** @var Ship[][] $groupedShips */
        $groupedShips = Grouper::group($ships, fn(Ship $ship) => $ship->getLocationKey());

        $destructions = [];

        foreach ($surfaces as $surface) {
            $locationKey = $surface->getPlanet()->getLocation()->getKey();

            if (!array_key_exists($locationKey, $groupedShips)) {
                continue;
            }

            $ships = $groupedShips[$locationKey];

            if (IDiplomacyMap::ENEMY != $diplomacyMap->getRelation($surface->getOwner(), $ships[0]->getOwner())) {
                continue;
            }

            $destruction = new Destruction();
            $destruction->setPlanetSurface($surface);
            $destruction->setShips($ships);

            $destructions[] = $destruction;
        }

        return $destructions;
    }
}