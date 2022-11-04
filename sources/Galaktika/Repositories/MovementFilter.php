<?php

namespace Galaktika\Repositories;

use Galaktika\Data\GameTurn;
use Galaktika\Data\Subject;

class MovementFilter
{
    private ?GameTurn $gameTurn;
    private ?Subject $subject;
    private ?string $axisKey;

    public function getGameTurn(): ?GameTurn
    {
        return $this->gameTurn;
    }

    public function setGameTurn(?GameTurn $gameTurn): MovementFilter
    {
        $this->gameTurn = $gameTurn;

        return $this;
    }

    public function getSubject(): ?Subject
    {
        return $this->subject;
    }

    public function setSubject(?Subject $subject): MovementFilter
    {
        $this->subject = $subject;

        return $this;
    }

    public function getAxisKey(): ?string
    {
        return $this->axisKey;
    }

    public function setAxisKey(?string $axisKey): MovementFilter
    {
        $this->axisKey = $axisKey;

        return $this;
    }

}