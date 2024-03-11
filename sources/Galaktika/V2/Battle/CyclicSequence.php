<?php

namespace Galaktika\V2\Battle;

use Galaktika\V2\Math\IRandomGenerator;

class CyclicSequence implements IRandomGenerator
{
    private array $cycle;

    /**
     * @param array $cycle
     */
    public function __construct(array $cycle)
    {
        $this->cycle = $cycle;
    }

    public function next(): float
    {
        $result = next( $this->cycle );

        if ( $result === false ) {
            $result = reset($this->cycle);
        }

        return $result;
    }

    public function nextArray(int $count): array
    {
        $resultArray = [];

        for ( $i=0; $i < $count; $i++) {
            $resultArray[] = $this->next();
        }

        return $resultArray;
    }


}