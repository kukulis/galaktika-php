<?php

namespace Galaktika\Util;

class Couple implements HasKey
{
    private HasKey $a;
    private HasKey $b;

    /**
     * @param HasKey $a
     * @param HasKey $b
     */
    public function __construct(HasKey $a, HasKey $b)
    {
        $this->a = $a;
        $this->b = $b;
    }

    public function getA(): HasKey
    {
        return $this->a;
    }

    public function getB(): HasKey
    {
        return $this->b;
    }

    public function getKey(): string
    {
        $keyA = $this->a->getKey();
        $keyB = $this->b->getKey();

        if ( strcmp( $keyA, $keyB) > 0  ) {
            list($keyA, $keyB) = [$keyB, $keyA];
        }
        return $keyA .':'. $keyB;
    }

    public function setKey(string $key)
    {
        throw new \Exception('The key for couple is build from its elements');
    }
}