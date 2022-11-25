<?php

function isPrime($n)
{
    // Corner case
    if ($n <= 1) {
        return false;
    }

    // Check from 2 to n-1
    for ($i = 2; $i < $n; $i++) {
        if ($n % $i == 0) {
            return false;
        }
    }

    return true;
}

function gap($g, $m, $n)
{
    $previousPrime = 2;
    for ($i = $m; $i <= $n; $i++) {
        if (isPrime($i)) {
            if ($i - $previousPrime == $g) {
                return [$previousPrime, $i];
            }
            $previousPrime = $i;
        }
    }

    return null;
}