<?php

namespace Galaktika\V2\Data;

interface IDiplomacyMap
{
    const ENEMY=0;
    const PEACE=1;
    const ALLIES=2;
    public function getRelation(Race $race1, Race $race2) : int;
}