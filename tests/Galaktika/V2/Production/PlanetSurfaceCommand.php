<?php

namespace Tests\Galaktika\V2\Production;

use Galaktika\V2\Data\PlanetSurface;

interface PlanetSurfaceCommand
{
    public const COMMAND_DECOMPOSE = 'DECOMPOSE';
    public const COMMAND_INDUSTRY = 'INDUSTRY';
    public const COMMAND_MATERIAL = 'MATERIAL';
    public const COMMAND_RESEARCH = 'RESEARCH';
    public const COMMAND_SHIP = 'SHIP';

    public function execute(PlanetSurface $planetSurface): PlanetSurface;

    public function getCode(): string;
}