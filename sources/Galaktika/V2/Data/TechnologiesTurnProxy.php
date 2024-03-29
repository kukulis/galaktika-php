<?php

namespace Galaktika\V2\Data;

class TechnologiesTurnProxy
{
    private array $technologiesInTurn=[];


    public function get(int $turn=0): ?Technologies {
        if ( $turn == 0 ) {
            $turn = GlobalTurnProxy::getInstance()->getTurn();
        }

        if ( !array_key_exists($turn, $this->technologiesInTurn) ) {
            return null;
        }

        return $this->technologiesInTurn[$turn];
    }

    public function set(Technologies $t, int $turn=0) : Technologies{

        if( $turn == 0) {
            $turn = GlobalTurnProxy::getInstance()->getTurn();
        }
        $this->technologiesInTurn[$turn] = $t;

        return $t;
    }
}