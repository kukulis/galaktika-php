<?php

namespace Galaktika\Various;

class RailEncryptor
{
    public static function encodeRailFenceCipher($string, $numberRails) {
        $allRails=array_fill(0, $numberRails, []);

        $railIndex = 0;
        $direction = 1;
        $characters = str_split($string);
        foreach ($characters as $c) {
            $allRails[$railIndex][] = $c;

            if ( $direction == 1 && $railIndex == $numberRails - 1 ) {
                $direction = -1;
            }
            if ( $direction == -1 && $railIndex == 0 ) {
                $direction = 1;
            }

            $railIndex += $direction;
        }


        $resultArray = [];
        foreach($allRails as $rail ) {
            $resultArray = array_merge ($resultArray, $rail);
        }

        return join( $resultArray );
    }

    public static function decodeRailFenceCipher($string, $numberRails) {
        $n = strlen($string);
        // instead of cutting string, we will use an array of indexes

        // it is too difficult to make analytic formula, so we will imitate encoding process
        $iiBounds = array_fill(0, $numberRails, 0);
        $railIndex = 0;
        $direction = 1;
        for ( $i=0; $i< $n; $i++) {
            $iiBounds[$railIndex] ++;

            if ( $direction == 1 && $railIndex == $numberRails - 1 ) {
                $direction = -1;
            }
            if ( $direction == -1 && $railIndex == 0 ) {
                $direction = 1;
            }

            $railIndex += $direction;
        }

        $ii = [0];

        // we will get an extra element after this cycle, but will not change the result
        $sum = 0;
        foreach ($iiBounds as $bound) {
            $sum += $bound;
            $ii[] = $sum;
        }


        // decrypting

        $railIndex = 0;
        $direction = 1;
        $decoded = [];
        for ( $i=0; $i < $n; $i++) {
            $decoded[] = $string[$ii[$railIndex]];

            $ii[$railIndex] = $ii[$railIndex] +1;

            if ( $direction == 1 && $railIndex == $numberRails - 1 ) {
                $direction = -1;
            }
            if ( $direction == -1 && $railIndex == 0 ) {
                $direction = 1;
            }

            $railIndex += $direction;
        }

        return join($decoded);
    }

}