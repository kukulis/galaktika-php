<?php

namespace Galaktika\V2\Data;

class Game
{
    private string $name='';
    private int $turn=0;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): Game
    {
        $this->name = $name;
        return $this;
    }

    public function getTurn(): int
    {
        return $this->turn;
    }

    public function setTurn(int $turn): Game
    {
        $this->turn = $turn;
        return $this;
    }

}