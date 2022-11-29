<?php

namespace Galaktika\Various;

class Sq2Squares
{
    public static function decompose($n) {
        return self::decomposeNumber($n-1, $n*$n);
    }

    public static function decomposeNumber($element, $number) : ?array {
        $maxElement = intval( floor(sqrt($number)) );
        $element = min($maxElement, $element);

        if ( $element * $element == $number ) {
            return [$element];
        }

        while ( $element > 0 ) {
            $decomposed = self::decomposeNumber($element-1, $number - ($element*$element));
            if ( $decomposed != null ) {
                $decomposed[] = $element;
                return $decomposed;
            }

            $element --;
        }

        return null;
    }
}