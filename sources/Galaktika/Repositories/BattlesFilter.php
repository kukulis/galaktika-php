<?php

namespace Galaktika\Repositories;

use Galaktika\Data\GameTurn;
use Galaktika\Data\Subject;

class BattlesFilter
{
    private ?GameTurn $gameTurn;
    private ?Subject $subject;

    public function getGameTurn(): ?GameTurn
    {
        return $this->gameTurn;
    }

    public function setGameTurn(?GameTurn $gameTurn): BattlesFilter
    {
        $this->gameTurn = $gameTurn;

        return $this;
    }

    public function getSubject(): ?Subject
    {
        return $this->subject;
    }

    public function setSubject(?Subject $subject): BattlesFilter
    {
        $this->subject = $subject;

        return $this;
    }
}