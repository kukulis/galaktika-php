<?php

namespace Galaktika\Repositories;

use Galaktika\Data\Fleet;
use Galaktika\Data\Subject;

interface RelationsRepository
{
    public function areSubjectsInWar(Subject $subject1, Subject $subject2): bool;

    public function areFleetsInWar(Fleet $fleet1, Fleet $fleet2): bool;

    public function areFleetsIdsInWar(string $fleetId1, string $fleetId2): bool;
}