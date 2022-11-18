<?php

namespace Galaktika\Util;

class PairsIterator
{
    private int $iA;
    private int $iB;
    private array $elements;

    /**
     * @param array $elements
     */
    public function __construct(array $elements)
    {
        $this->elements = $elements;
        $this->iA = 0;
        $this->iB = 0;
    }

    public function finished(): bool {
         return ($this->iA >= count($this->elements)) ||  ($this->iB >= count($this->elements));
    }

    public function next(): bool {
        $this->iB ++;

        if ( $this->iB >= count($this->elements)) {
            $this->iA ++;
            $this->iB = $this->iA+1;
        }

        return !$this->finished();
    }

    public function getA() {
        if ( $this->finished()) {
            return null;
        }

        return $this->elements[$this->iA];
    }

    public function getB() {
        if ( $this->finished()) {
            return null;
        }

        return $this->elements[$this->iB];
    }
}