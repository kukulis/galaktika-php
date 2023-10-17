<?php

namespace Galaktika\V2\Data;

interface ILocation
{
    public function getX(): float;

    public function setX(float $x): self;

    public function getY(): float;

    public function setY(float $y): self;
}