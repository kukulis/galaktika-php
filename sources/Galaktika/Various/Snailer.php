<?php

namespace Galaktika\Various;

class Snailer
{
    public static function snail(array $array): array {
        if ( count($array) == 0 || count($array[0] ) == 0 ) {
            return [];
        }
        $visited =[];
        for($i=0; $i < count($array); $i++) {
            $visited[] = [];
            for($j=0; $j < count($array[$i]); $j++) {
                $visited[$i][]=false;
            }
        }

        $i=0; $j=0;
        $result = [];

        $right = fn ($ii, $jj) => [$ii, $jj+1];
        $bottom = fn ($ii, $jj) => [$ii+1, $jj];
        $left = fn ($ii, $jj) => [$ii, $jj-1];
        $up = fn ($ii, $jj) => [$ii-1, $jj];

        $previousDirection = $right;

        while (true) {
            $result[] = $array[$i][$j];
            $visited[$i][$j] = true;

            $found = false;
            foreach (  [$previousDirection, $right, $bottom, $left, $up] as $direction ) {
                list($ii, $jj) = $direction($i, $j);
                if (array_key_exists($ii, $array) && array_key_exists($jj, $array[$ii]) && !$visited[$ii][$jj] ) {
                    $found = true;
                    $i = $ii;
                    $j = $jj;
                    $previousDirection = $direction;
                    break;
                }
            }
            if (!$found) {
                break;
            }
        }

        return $result;
    }
}