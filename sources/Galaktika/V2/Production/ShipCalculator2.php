<?php

namespace Galaktika\V2\Production;

use Galaktika\V2\Data\Ship;
use Galaktika\V2\Data\Technologies;

class ShipCalculator2
{
    public static function calculate(ShipModel $shipModel, Technologies $techologies) : Ship
    {
        $ship = new Ship();

        $ship->setId(uniqid());
        $ship->setModelName($shipModel->getName());
        $ship->setModelId($shipModel->getId());

        $mass = $shipModel->getMass();
        $nonDefenceMass = $shipModel->getNonDefenceMass();

        $ship->setMass($mass);
        $ship->setDefence($shipModel->getDefenceMass() * $techologies->getDefence() / sqrt($nonDefenceMass));
        $ship->setAttack($shipModel->getAttackMass() * $techologies->getAttack());
        $ship->setGuns($shipModel->getGuns());
        $ship->setMaxCargo($shipModel->getCargoMass() * $techologies->getCargo());
        $ship->setSpeed($shipModel->getEngineMass() * $techologies->getEngines() / $mass);

        return $ship;
    }
}