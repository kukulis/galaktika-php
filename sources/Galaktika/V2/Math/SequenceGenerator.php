<?php

namespace Galaktika\V2\Math;

use Galaktika\V2\Battle\RandomSequence;

class SequenceGenerator
{

    public static function generate(array $randoms): array
    {
        $size = count($randoms);

        $indexes = [];
        for ($i = 0; $i < $size; $i++) {
            $indexes[$i] = $i;
        }

        $result = [];
        foreach ($randoms as $random) {
            if ($random >= 1) {
                $random = RandomSequence::ALMOST1;
            }
            $selected = intval($random * $size);
            $result[] = $indexes[$selected];
            $indexes[$selected] = $indexes[$size - 1];
            // for debugging
            unset($indexes[$size - 1]);
            $size--;
        }

        return $result;
    }

    public static function reorder(array $data, array $indexes): array
    {
        $rez = [];
        foreach ($indexes as $i) {
            $rez[] = $data[$i];
        }

        return $rez;
    }
}