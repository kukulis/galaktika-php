<?php

namespace Galaktika\Util;

class Grouper
{
    public static function group(array $data, callable $keyGetter): array
    {
        $grouped = [];
        foreach ($data as $elem) {
            $key = call_user_func($keyGetter, $elem);
            if (!array_key_exists($key, $grouped)) {
                $grouped[$key] = [];
            }

            $grouped[$key][] = $elem;
        }

        return $grouped;
    }
}