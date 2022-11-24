<?php

namespace Galaktika\Various;

class PangramDetector
{
    public static function detect_pangram($string) {
        #your code here
        $string = strtolower($string);
        $alphabet = 'abcdefghijklmnopqrstuvwxyz';
        $alphabetArray = str_split($alphabet);

        $alphabetSet = [];
        foreach ($alphabetArray as $c ) {
            $alphabetSet[$c] = 0;
        }


        for($i=0; $i < strlen($string); $i++) {
            $c = $string[$i];
            if ( array_key_exists($c, $alphabetSet) ) {
                $alphabetSet[$c] = 1 ;
            }
        }

        return array_sum($alphabetSet) == count ($alphabetSet);
    }
}