<?php

namespace Galaktika\Data;

class ShipProductionProtocol
{
    private ShipProject $shipProject;
    private Technologies $techologies;

    public function getShipProject(): ShipProject
    {
        return $this->shipProject;
    }

    public function setShipProject(ShipProject $shipProject): void
    {
        $this->shipProject = $shipProject;
    }

    public function getTechologies(): Technologies
    {
        return $this->techologies;
    }

    public function setTechologies(Technologies $techologies): void
    {
        $this->techologies = $techologies;
    }
}