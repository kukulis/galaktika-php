<?php

namespace Tests\Galaktika\V2\Production;

use Galaktika\V2\Data\PlanetSurface;

class ShipCommand implements PlanetSurfaceCommand
{
    public function execute(PlanetSurface $planetSurface): PlanetSurface
    {
        // TODO: Implement execute() method.
        return $planetSurface;
    }

    public function getCode(): string
    {
        return self::COMMAND_SHIP;
    }


}