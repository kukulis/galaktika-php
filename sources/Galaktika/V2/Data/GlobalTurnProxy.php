<?php

namespace Galaktika\V2\Data;

class GlobalTurnProxy
{
    private int $turn = 1;

    private static ?GlobalTurnProxy $instance = null;

    public static function getInstance(): self
    {
        if (static::$instance == null) {
            static::$instance = new GlobalTurnProxy();
        }

        return static::$instance;
    }

    public function getTurn(): int
    {
        return $this->turn;
    }

    public function setTurn(int $turn): GlobalTurnProxy
    {
        $this->turn = $turn;
        return $this;
    }
}