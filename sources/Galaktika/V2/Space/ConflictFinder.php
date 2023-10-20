<?php

namespace Galaktika\V2\Space;

use Galaktika\V2\Battle\Conflict;
use Galaktika\V2\Data\IDiplomacyMap;
use Galaktika\V2\Data\Ship;

class ConflictFinder
{
    private const EPSILON=0.00001;

    /**
     * @param Ship[] $ships
     * @return Conflict[]
     */
    public function findConflicts(array $ships, IDiplomacyMap $diplomacyMap) : array {
        // TODO
        return [];
    }
}