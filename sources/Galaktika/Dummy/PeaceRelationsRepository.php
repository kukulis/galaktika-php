<?php

namespace Galaktika\Dummy;

use Galaktika\Data\Fleet;
use Galaktika\Data\Subject;
use Galaktika\Exceptions\UnimplementedException;
use Galaktika\Repositories\RelationsRepository;
use Galaktika\Util\Couple;

class PeaceRelationsRepository implements RelationsRepository
{
    /**
     * @var Couple[]
     */
    private array $peacePairs = [];

    public function addPeace(Subject $s1, Subject $s2)
    {
        $couple = new Couple($s1, $s2);

        $this->peacePairs[$couple->getKey()] = $couple;
    }

    public function isInPeace(Subject $s1, Subject $s2): bool
    {
        $couple = new Couple($s1, $s2);

        $key = $couple->getKey();

        return array_key_exists($key, $this->peacePairs);
    }

    public function areSubjectsInWar(Subject $subject1, Subject $subject2): bool
    {
        return !$this->isInPeace($subject1, $subject2);
    }

    public function areFleetsInWar(Fleet $fleet1, Fleet $fleet2): bool
    {
        return !$this->isInPeace($fleet1->getOwner(), $fleet2->getOwner());
    }

    public function areFleetsIdsInWar(string $fleetId1, string $fleetId2): bool
    {
        throw new UnimplementedException(self::class.' areFleetsIdsInWar');
    }
}