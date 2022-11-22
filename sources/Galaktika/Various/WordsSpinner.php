<?php

namespace Galaktika\Various;

class WordsSpinner
{
    public static function spinWords($str) {
        $words = explode( ' ', $str);

        $spinedWords = [];
        foreach ( $words as $word) {
            if (strlen($word) >= 5 ) {
                $word = strrev($word);
            }

            $spinedWords[] = $word;
        }

        return join ( ' ', $spinedWords);
    }
}