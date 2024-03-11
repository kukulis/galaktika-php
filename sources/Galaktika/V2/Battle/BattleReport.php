<?php

namespace Galaktika\V2\Battle;

use Galaktika\V2\Data\Fleet;

class BattleReport
{
    private Fleet $beforeFleetA;
    private Fleet $beforeFleetB;

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

    /**
     * @param BattleReportLine[]  $shots
     */
    public function setShots(array $shots): self
    {
        $this->shots = $shots;

        return $this;
    }

    public function addShot(BattleReportLine $shot): self
    {
        $this->shots[] = $shot;

        return $this;
    }

    public function getBeforeFleetA(): Fleet
    {
        return $this->beforeFleetA;
    }

    public function setBeforeFleetA(Fleet $beforeFleetA): BattleReport
    {
        $this->beforeFleetA = $beforeFleetA;
        return $this;
    }

    public function getBeforeFleetB(): Fleet
    {
        return $this->beforeFleetB;
    }

    public function setBeforeFleetB(Fleet $beforeFleetB): BattleReport
    {
        $this->beforeFleetB = $beforeFleetB;
        return $this;
    }
}