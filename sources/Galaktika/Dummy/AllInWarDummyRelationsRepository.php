<?php

namespace Galaktika\Dummy;

use Galaktika\Data\Fleet;
use Galaktika\Data\Subject;
use Galaktika\Repositories\RelationsRepository;

class AllInWarDummyRelationsRepository implements RelationsRepository
{
    public function areSubjectsInWar(Subject $subject1, Subject $subject2): bool
    {
        return true;
    }

    public function areFleetsInWar(Fleet $fleet1, Fleet $fleet2): bool
    {
        return true;
    }

    public function areFleetsIdsInWar(string $fleetId1, string $fleetId2): bool
    {
        return true;
    }
}