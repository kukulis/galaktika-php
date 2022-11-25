<?php

namespace Galaktika\Various;

class BurrowWheelerTransformer
{
    private $s;
    private $n;

    /**
     * @param string $s
     */
    public function __construct($s)
    {
        $this->s = $s;
        $this->n = strlen($s);
    }

    /**
     * Compares substrings, starting from the given indexes, finishing till end of the string
     * and then continuing from the beginning of the string.
     */
    public function compareSubstrings($i, $j)
    {
        $result = 0;
        $attempts = 0;
        while ($result == 0 && $attempts < $this->n) {
            $result = $this->s[$i] <=> $this->s[$j];
            $attempts++;
            $i = $this->nextIndex($i);
            $j = $this->nextIndex($j);
        }

        return $result;
    }

    public function nextIndex($i)
    {
        if ($i >= $this->n - 1) {
            return 0;
        }

        return $i + 1;
    }

    public function previousIndex($i)
    {
        if ($i == 0) {
            return $this->n - 1;
        }

        return $i - 1;
    }

    public function createIndexes()
    {
        $ii = [];
        for ($i = 0; $i < $this->n; $i++) {
            $ii[] = $i;
        }

        return $ii;
    }

    public function encodeMine() {
        $ii = $this->createIndexes();
        usort($ii, [$this,'compareSubstrings']);

        $factor = array_search(0, $ii);

        $encodedCharacters = [];
        foreach ($ii as $i ) {
            // previous index actually is the index of the last character in the given cycled substring.
            $encodedCharacters[] = $this->s[$this->previousIndex($i)];
        }

        return [ join($encodedCharacters), $factor ];
    }

    public static function encode($s) {
        $bwt = new BurrowWheelerTransformer($s);

        return $bwt->encodeMine();
    }


    /**
     * Compares characters in the string by the given indexes.
     * If the characters are equal, then compare indexes themselves.
     * Without the second condition the algorithm doesn't work :).
     * Perhaps this is because sorting the indexes, helps to  determine unique indexing sequence :)
     */
    public function compareCharacters($i, $j)
    {
        $result = $this->s[$i] <=> $this->s[$j];
        if ( $result == 0 ) {
            $result = $i <=> $j;
        }

        return $result;
    }


    /**
     * @param int $start
     */
    public function decodeMine($start) {
        $ii = $this->createIndexes();
        usort($ii, [$this,'compareCharacters']);

        $result = [];
        $current = $start;
        for ( $k = 0; $k < $this->n; $k++ ) {
            $current = $ii[$current];
            $result[] = $this->s[$current];
        }

        return join($result);
    }

    public static function decode($encoded, $factor) {
        $bwt = new BurrowWheelerTransformer($encoded);

        return $bwt->decodeMine($factor);
    }
}