<?php

namespace Tests\Galaktika\V2\Production;

use Galaktika\V2\Data\PlanetSurface;

class DecomposeCommand implements PlanetSurfaceCommand
{
    public function execute(PlanetSurface $planetSurface): PlanetSurface
    {
        // TODO
        return $planetSurface;
    }

    public function getCode(): string
    {
        return self::COMMAND_DECOMPOSE;
    }
}