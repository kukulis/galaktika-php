<?php

namespace Galaktika\V2\Battle;

use Galaktika\V2\Math\IRandomGenerator;
use OutOfBoundsException;

class RandomSequence implements IRandomGenerator
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

        $rez = $this->randoms[$this->current++];
        if ( $rez >= 1) {
            return self::ALMOST1;
        }

        return $rez;
    }

    /**
     * @return float[]
     */
    public function nextArray(int $count): array
    {
        $rez = [];
        for ($i = 0; $i < $count; $i++) {
            $rez[] = $this->next();
        }

        return $rez;
    }
}