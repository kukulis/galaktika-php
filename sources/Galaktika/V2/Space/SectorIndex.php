<?php

namespace Galaktika\V2\Space;

class SectorIndex
{
    private int $i;
    private int $j;

    /**
     * @param int $i
     * @param int $j
     */
    public function __construct(int $i, int $j)
    {
        $this->i = $i;
        $this->j = $j;
    }

    /**
     * @return int
     */
    public function getI(): int
    {
        return $this->i;
    }

    /**
     * @return int
     */
    public function getJ(): int
    {
        return $this->j;
    }
}