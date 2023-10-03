<?php

namespace Galaktika\V2\Battle;

use OutOfBoundsException;

class RandomSequence
{
    private array $randoms;
    private int $current = 0;

    /**
     * @param array $randoms
     */
    public function __construct(array $randoms)
    {
        $this->randoms = $randoms;
    }


    public function next(): float
    {
        if ($this->current >= count($this->randoms)) {
            throw new  OutOfBoundsException(
                sprintf('RandomSequence: current index %s exceed available randoms', $this->current)
            );
        }

        return $this->randoms[$this->current++];
    }
}