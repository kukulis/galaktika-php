<?php

namespace Galaktika\Various;

function init($n): array {
    $ii = [];
    for($i=0; $i<$n; $i++) {
        $ii[] = $i;
    }

    return $ii;
}

function next(array $ii, $max ): ?array {
    $j = count($ii) - 1;

    while ( $j >= 0 && $ii[$j] >= $max - count($ii) + $j ) {
        $j--;
    }

    if ( $j < 0 ) {
        return null;
    }

    $ii[$j] = $ii[$j] + 1;

    for ( $l=$j+1; $l < count($ii); $l++) {
        $ii[$l] = $ii[$l-1]+1;
    }

    return $ii;
}

class Towns
{

    /**
     * Full seek solution.
     *
     * @var $t int kilometers
     * @var $k int amount of towns
     * @var $ls array prices of towns
     * @return int the best sum of the chosen towns
     */
    public static function chooseBestSum($t, $k, $ls) {
        if( count($ls) < $k ) {
            return null;
        }

        $ii = init($k);
        $solution = 0;

        while ( true) {

            $candidateSolution = 0;
            foreach ($ii as $i ) {
                $candidateSolution += $ls[$i];
            }

            if ( $candidateSolution <= $t && $candidateSolution > $solution) {
                $solution = $candidateSolution;
            }

            $ii = next($ii, count($ls));
            if ( $ii == null ) break;
        }

        if( $solution == 0 ) {
            return null;
        }

        return $solution;
    }
    /**
     * First we make the initial solution.
     * Next we try to enhance solution by swapping each town from the available solution, to the better one.
     *
     * @var $t int kilometers
     * @var $k int amount of towns
     * @var $ls array prices of towns
     * @return int the best sum of the chosen towns
     */
    public static function chooseBestSum_old($t, $k, $ls)
    {
        if ($k > count($ls)) {
            return null;
        }

        sort($ls);

        $visitedSet = [];
        $solution = 0;
        for ($i = 0; $i < count($ls); $i++) {
            $visitedSet[$i] = false;
            // minimal solution
            // assuming, that town prices are sorted in an ascending order
            if ($i < $k) {
                $visitedSet[$i] = true;
                $solution += $ls[$i];
            }
        }

        for ($i = count($ls) - 1; $i >= 0; $i--) {
            // first we choose already selected town
            if (!$visitedSet[$i]) {
                continue;
            }

            $current = $i;

            // next we try to swap it with another town which is not selected
            for ($j = 0; $j < count($ls); $j++) {
                if ($visitedSet[$j]) {
                    continue;
                }
                $newSolution = $solution - $ls[$current] + $ls[$j];

                // better solution is the one which is in less distance from the requested amount -- $t
//                    if ($newSolution <= $t && $newSolution > $solution) {
                if (abs($newSolution - $t) < abs($solution - $t)) {
                    $visitedSet[$current] = false;
                    $visitedSet[$j] = true;
                    $current = $j;
                    $solution = $newSolution;
                }
            }
        }

        for ($i = count($ls) - 1; $i >= 0; $i--) {
            // first we choose already selected town
            if (!$visitedSet[$i]) {
                continue;
            }

            $current = $i;

            // next we try to swap it with another town which is not selected
            for ($j = 0; $j < count($ls); $j++) {
                if ($visitedSet[$j]) {
                    continue;
                }
                $newSolution = $solution - $ls[$current] + $ls[$j];

                // better solution is the one which is in less distance from the requested amount -- $t
                if ($newSolution <= $t && $newSolution > $solution || $solution > $t && $newSolution < $solution) {
//                if (abs($newSolution - $t) < abs($solution - $t)) {
                    $visitedSet[$current] = false;
                    $visitedSet[$j] = true;
                    $current = $j;
                    $solution = $newSolution;
                }
            }
        }



        // if we needed we might extract exact towns list from the $visitedSet

        if ($solution > $t) {
            return null;
        }

        return $solution;
    }

    public static function next(array $ii, int $max) : ?array {
        return next($ii, $max);
    }

    public static function init($n): array {
        return init($n);
    }
}