<?php

namespace Galaktika\V2\Battle;

use Galaktika\V2\Data\Ship;

class BattleReportLine
{
    private Ship $shooter;
    private Ship $target;
    private bool $destroyed;

    public static function create(Ship $shooter, Ship $target, bool $destroyed): BattleReportLine {
        $line = new BattleReportLine();

        $line->setShooter($shooter);
        $line->setTarget($target);
        $line->setDestroyed($destroyed);

        return $line;
    }

    public function getShooter(): Ship
    {
        return $this->shooter;
    }

    public function setShooter(Ship $shooter): BattleReportLine
    {
        $this->shooter = $shooter;

        return $this;
    }

    public function getTarget(): Ship
    {
        return $this->target;
    }

    public function setTarget(Ship $target): BattleReportLine
    {
        $this->target = $target;

        return $this;
    }

    public function isDestroyed(): bool
    {
        return $this->destroyed;
    }

    public function setDestroyed(bool $destroyed): BattleReportLine
    {
        $this->destroyed = $destroyed;

        return $this;
    }


}