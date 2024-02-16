<?php

namespace Galaktika;

/**
 * For testing purposes
 */
class SequenceIdGenerator implements IdGenerator
{
    private array $sequence;

    /**
     * @param array $sequence
     */
    public function __construct(array $sequence)
    {
        $this->sequence = $sequence;
    }


    public function generateId(): string
    {
        $cur = current($this->sequence);
        next($this->sequence);

        return $cur;
    }
}