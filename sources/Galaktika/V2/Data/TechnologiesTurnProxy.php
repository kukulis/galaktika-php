<?php

namespace Galaktika\V2\Data;

class TechnologiesTurnProxy
{
    private array $technologiesInTurn=[];

    private int $currentTurn = 1;

    public function getCurrentTurn(): int
    {
        return $this->currentTurn;
    }

    public function setCurrentTurn(int $currentTurn): TechnologiesTurnProxy
    {
        $this->currentTurn = $currentTurn;
        return $this;
    }

    public function get(): Technologies {
        return $this->technologiesInTurn[$this->currentTurn];
    }

    public function set(Technologies $t) : Technologies{
        $this->technologiesInTurn[$this->currentTurn] = $t;

        return $t;
    }
}