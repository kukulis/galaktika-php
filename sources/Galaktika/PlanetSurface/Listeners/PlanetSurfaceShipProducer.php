<?php

namespace Galaktika\PlanetSurface\Listeners;

use Galaktika\Data\Ship;
use Galaktika\Data\ShipGroup;
use Galaktika\Data\ShipProject;
use Galaktika\Data\Technologies;
use Galaktika\Events\PlanetSurfaceTurnEvent;
use Galaktika\IdGenerator;

class PlanetSurfaceShipProducer extends PlanetSurfaceWorkerBase
{
    private IdGenerator $idGenerator;

    public function __construct(IdGenerator $idGenerator)
    {
        $this->idGenerator = $idGenerator;
    }

    public function call(PlanetSurfaceTurnEvent $event)
    {
        if ($event->getProductionMode() == 'ship') {
            $productionPower = $this - $this->getProductionPower($event);
            $capitalBoost = min($productionPower, $event->getPlanetSurface()->getCapital());

            $shipProductionPower = $productionPower + $capitalBoost;
            $requiredShipProductionPower = 2 * $event->getPlanetSurface()->getShipProject()->getWeight();

            $ship = $this->calculateShip($event->getPlanetSurface()->getShipProject(), $event->getTechnologies());
            $ship->setId($this->idGenerator->generateId());

            $shipGroup = new ShipGroup();

            $shipGroup->setId($this->idGenerator->generateId());
            $shipGroup->setShip($ship);
            $amount = $event->getPlanetSurface()->getProducedShipPart(
                ) + $shipProductionPower / $requiredShipProductionPower;
            $producedAmount = floor($amount);
            $remainingPart = $amount - $producedAmount;
            $shipGroup->setAmount($remainingPart);

            $event->getNewPlanetSurface()->setProducedShipPart($remainingPart);
            $event->getNewPlanetSurface()->setCapital($event->getPlanetSurface()->getCapital() - $capitalBoost);
            $event->setProducedShipGroup($shipGroup);
        }
    }

    public static function calculateShip(ShipProject $shipProject, Technologies $technologies) : Ship
    {
        $ship = new Ship();

        $ship->setGuns($shipProject->getGuns());
        $ship->setAttack($shipProject->getGunMass() * $technologies->getAttack());
        $ship->setDefence($shipProject->getShieldMass() * $technologies->getDefence());
        $ship->setEngine($shipProject->getEngineMass() * $technologies->getEngine());
        $ship->setCargo($shipProject->getCargoMass() * $technologies->getCargo());
        $ship->setWeight($shipProject->getWeight());

        return $ship;
    }
}