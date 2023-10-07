<?php

namespace Galaktika\V2\Battle;

use Galaktika\V2\Data\Ship;

/**
 * For ShipsHolder only!
 */
class ShipHolder
{
    public ?Ship $ship=null;
    public int $allIndex=0;
    public int $aIndex=0;
    public int $bIndex=0;

    /**
     * @param Ship|null $ship
     */
    public function __construct(?Ship $ship)
    {
        $this->ship = $ship;
    }


    public function setShip(?Ship $ship): ShipHolder
    {
        $this->ship = $ship;

        return $this;
    }

    public function setAllIndex(int $allIndex): ShipHolder
    {
        $this->allIndex = $allIndex;

        return $this;
    }

    public function setAIndex(int $aIndex): ShipHolder
    {
        $this->aIndex = $aIndex;

        return $this;
    }

    public function setBIndex(int $bIndex): ShipHolder
    {
        $this->bIndex = $bIndex;

        return $this;
    }

}