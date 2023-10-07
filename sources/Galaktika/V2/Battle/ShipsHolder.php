<?php

namespace Galaktika\V2\Battle;

use Galaktika\V2\Data\Ship;

class ShipsHolder
{
    /** @var ShipHolder[] */
    private array $allShipsById = [];
    /** @var ShipHolder[] */
    private array $allShipsByIndex = [];
    /** @var ShipHolder[] */
    private array $aShipsById = [];
    /** @var ShipHolder[] */
    private array $aShipsByIndex = [];
    /** @var ShipHolder[] */
    private array $bShipsById = [];
    /** @var ShipHolder[] */
    private array $bShipsByIndex = [];

    /**
     * @param Ship[] $aShips indexed incrementally
     * @param Ship[] $bShips indexed incrementally
     */
    public function __construct(array $aShips, array $bShips)
    {
        foreach ($aShips as $aShip) {
            $shipHolder = new ShipHolder($aShip);
            $shipHolder->aIndex = count($this->aShipsByIndex);
            $shipHolder->bIndex = -1;
            $shipHolder->allIndex = count($this->allShipsByIndex);

            $this->allShipsByIndex[] = $shipHolder;
            $this->aShipsByIndex[] = $shipHolder;
            $this->allShipsById[$aShip->getId()] = $shipHolder;
            $this->aShipsById[$aShip->getId()] = $shipHolder;
        }
        foreach ($bShips as $bShip) {
            $shipHolder = new ShipHolder($bShip);
            $shipHolder->aIndex = -1;
            $shipHolder->bIndex = count($this->bShipsByIndex);
            $shipHolder->allIndex = count($this->allShipsByIndex);

            $this->allShipsByIndex[] = $shipHolder;
            $this->bShipsByIndex[] = $shipHolder;
            $this->allShipsById[$bShip->getId()] = $shipHolder;
            $this->bShipsById[$bShip->getId()] = $shipHolder;
        }
    }

    public function getAByIndex(int $i): Ship
    {
        return $this->aShipsByIndex[$i]->ship;
    }

    public function getBByIndex(int $i): Ship
    {
        return $this->bShipsByIndex[$i]->ship;
    }

    public function getByIndex(int $i): Ship
    {
        return $this->allShipsByIndex[$i]->ship;
    }

    public function getByKey(string $key): ?Ship
    {
        if (!array_key_exists($key,  $this->allShipsById)) {
            return null;
        }

        return $this->allShipsById[$key]->ship;
    }

    public function getAByKey(string $key): ?Ship
    {
        if (!array_key_exists($key,  $this->aShipsById)) {
            return null;
        }

        return $this->aShipsById[$key]->ship;
    }

    public function getBByKey(string $key): ?Ship
    {
        if (!array_key_exists($key,  $this->bShipsById)) {
            return null;
        }

        return $this->bShipsById[$key]->ship;
    }

}