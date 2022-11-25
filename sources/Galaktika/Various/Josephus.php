<?php

namespace Galaktika\Various;

class Josephus
{
    public static function josephus_survivor(int $n, int $k): int
    {
        $participants = [];
        for ($i = 1; $i <= $n; $i++) {
            $participants[] = $i;
        }

        $i = ($k - 1 ) % count($participants);


        while (count($participants) > 1) {
            unset($participants[$i]);
            $participants = array_values($participants);

            $i = ($i + $k - 1) % count($participants);
        }

        return $participants[0];
    }
}