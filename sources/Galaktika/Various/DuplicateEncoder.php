<?php

namespace Galaktika\Various;

class DuplicateEncoder
{
    public static function duplicate_encode(string $str):string {

        $str = strtolower($str);

        $map = [];
        for ( $i=0; $i < strlen($str); $i++) {
            $c = $str[$i];
            if ( !array_key_exists($c, $map)) {
                $map[$c] = 0;
            }

            $map[$c] = $map[$c] + 1;
        }

        $result = [];
        for ( $i=0; $i < strlen($str); $i++) {
            $c = $str[$i];
            if ( $map[$c] > 1 ) {
                $result[] = ')';
            }
            else {
                $result[] = '(';
            }
        }

        return join($result);
    }
}