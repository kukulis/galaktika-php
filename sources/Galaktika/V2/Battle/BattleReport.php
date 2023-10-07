<?php

namespace Galaktika\V2\Battle;

use Galaktika\V2\Data\Fleet;

class BattleReport
{
    private Fleet $fleetA;
    private Fleet $fleetB;

    /** @var BattleReportLine[] */
    private array $shots;

    public function getFleetA(): Fleet
    {
        return $this->fleetA;
    }

    public function setFleetA(Fleet $fleetA): BattleReport
    {
        $this->fleetA = $fleetA;

        return $this;
    }

    public function getFleetB(): Fleet
    {
        return $this->fleetB;
    }

    public function setFleetB(Fleet $fleetB): BattleReport
    {
        $this->fleetB = $fleetB;

        return $this;
    }

    /**
     * @return BattleReportLine[]
     */
    public function getShots(): array
    {
        return $this->shots;
    }

    public function setShots(array $shots): BattleReport
    {
        $this->shots = $shots;

        return $this;
    }

    public function addShot(BattleReportLine $shot)
    {
        $this->shots[] = $shot;
    }
}