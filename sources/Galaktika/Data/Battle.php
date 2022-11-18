<?php

namespace Galaktika\Data;

class Battle
{
    private Fleet $fleetA;
    private Fleet $fleetB;

    /**
     * @param Fleet $fleetA
     * @param Fleet $fleetB
     */
    public function __construct(Fleet $fleetA, Fleet $fleetB)
    {
        $this->fleetA = $fleetA;
        $this->fleetB = $fleetB;
    }

    public function getFleetA(): Fleet
    {
        return $this->fleetA;
    }

    public function getFleetB(): Fleet
    {
        return $this->fleetB;
    }
}