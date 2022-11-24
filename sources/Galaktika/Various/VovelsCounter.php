<?php

namespace Galaktika\Various;

class VovelsCounter
{
    public static function getCount($str): int {
        $vowelsCount = 0;

        if ( empty($str)) {
            return 0;
        }

        $countSymbols = function($string, array $symbols ) {
            $symbolsSet = array_flip($symbols);
            $count = 0;
            for ( $i=0; $i < strlen($string); $i++) {
                if ( array_key_exists($string[$i], $symbolsSet)) {
                    $count++;
                }
            }
            return $count;
        };

        return $countSymbols($str, ['a', 'e', 'i', 'o', 'u']);
    }
}