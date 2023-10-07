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

    public function remove(string $id) : bool {

        if (!array_key_exists($id,  $this->allShipsById)) {
            return false;
        }
        $shipHolderToRemove = $this->allShipsById[$id];

        // will switch with the last element
        $lastShipHolder = $this->allShipsByIndex[count($this->allShipsByIndex)-1];
        $lastAShipHolder = $this->aShipsByIndex[count($this->aShipsByIndex)-1];
        $lastBShipHolder = $this->bShipsByIndex[count($this->bShipsByIndex)-1];

        $lastShipHolder->allIndex = $shipHolderToRemove->allIndex;
        $this->allShipsByIndex[$shipHolderToRemove->allIndex] = $lastShipHolder;
        unset($this->allShipsByIndex[count($this->allShipsByIndex)-1]);

        $lastAShipHolder->aIndex = $shipHolderToRemove->aIndex;
        $this->aShipsByIndex[$shipHolderToRemove->aIndex] = $lastAShipHolder;
        unset($this->aShipsByIndex[count($this->aShipsByIndex)-1]);

        $lastBShipHolder->bIndex = $shipHolderToRemove->bIndex;
        $this->bShipsByIndex[$shipHolderToRemove->bIndex] = $lastBShipHolder;
        unset($this->bShipsByIndex[count($this->bShipsByIndex)-1]);

        unset( $this->allShipsById[$id]);
        unset( $this->aShipsById[$id]);
        unset( $this->bShipsById[$id]);

        return true;
    }

}