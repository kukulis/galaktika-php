<?php

namespace Galaktika\V2\Production;

use Galaktika\V2\Data\PlanetSurface;

class ResearchCommand implements PlanetSurfaceCommand
{
    public function execute(PlanetSurface $planetSurface): PlanetSurface
    {
        // TODO: Implement execute() method.
        return $planetSurface;
    }

    public function getCode(): string
    {
        return self::COMMAND_RESEARCH;
    }

}