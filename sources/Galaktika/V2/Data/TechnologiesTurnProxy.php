<?php

namespace Galaktika\V2\Data;

class TechnologiesTurnProxy
{
    private array $technologiesInTurn=[];


    public function get(): Technologies {
        return $this->technologiesInTurn[GlobalTurnProxy::getInstance()->getTurn()];
    }

    public function set(Technologies $t) : Technologies{
        $this->technologiesInTurn[GlobalTurnProxy::getInstance()->getTurn()] = $t;

        return $t;
    }
}