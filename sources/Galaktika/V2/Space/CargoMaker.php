<?php

namespace Galaktika\V2\Space;

use Galaktika\V2\Data\PlanetSurface;
use Galaktika\V2\Data\ShipCargo;

class CargoMaker
{
    public function loadPopulation(PlanetSurface $surface, float $amount, ShipCargo $shipCargo): float
    {
        $putAmount = min($shipCargo->getFreeSpace(), $amount, $surface->getPopulation());

        $shipCargo->setPopulation($shipCargo->getPopulation() + $putAmount);
        $surface->setPopulation($surface->getPopulation() - $putAmount);

        return $putAmount;
    }

    public function loadMaterials(PlanetSurface $surface, float $amount, ShipCargo $shipCargo)
    {
        $putAmount = min($shipCargo->getFreeSpace(), $amount, $surface->getMaterial());

        $shipCargo->setMaterial($shipCargo->getMaterial() + $putAmount);
        $surface->setMaterial($surface->getMaterial() - $putAmount);

        return $putAmount;
    }

    public function unloadPopulation(PlanetSurface $surface, float $amount, ShipCargo $shipCargo): float
    {
        $putAmount = min($surface->getFreeSpaceForPopulation(), $amount, $shipCargo->getPopulation());

        $shipCargo->setPopulation($shipCargo->getPopulation() - $putAmount);
        $surface->setPopulation($surface->getPopulation() + $putAmount);

        return $putAmount;
    }

    public function unloadMaterials(PlanetSurface $surface, float $amount, ShipCargo $shipCargo): float {
        $putAmount = min ( $shipCargo->getMaterial(), $amount );

        $shipCargo->setMaterial($shipCargo->getMaterial() - $putAmount);
        $surface->setMaterial($surface->getMaterial() + $putAmount );

        return $putAmount;
    }
}