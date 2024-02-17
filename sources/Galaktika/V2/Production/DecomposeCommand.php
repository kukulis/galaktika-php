<?php

namespace Galaktika\V2\Production;

use Galaktika\V2\Data\PlanetSurface;
use Galaktika\V2\Data\UnfinishedShip;

class DecomposeCommand implements PlanetSurfaceCommand
{
    private string $id;
    private UnfinishedShip $unfinishedShip;

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): DecomposeCommand
    {
        $this->id = $id;

        return $this;
    }

    public function getUnfinishedShip(): UnfinishedShip
    {
        return $this->unfinishedShip;
    }

    public function setUnfinishedShip(UnfinishedShip $unfinishedShip): DecomposeCommand
    {
        $this->unfinishedShip = $unfinishedShip;

        return $this;
    }

    public function execute(PlanetSurface $planetSurface, PlanetSurface $oldSurface, int $turn): void
    {
        $planetSurface->setMaterial( $planetSurface->getMaterial() + $this->unfinishedShip->getResourcesUsed() );
        $planetSurface->removeUnfinishedShip($this->unfinishedShip);
    }

    public function getCode(): string
    {
        return self::COMMAND_DECOMPOSE;
    }
}