<?php

namespace Galaktika\Util;

class Math
{
    public static function square(float $x) : float {
        return $x * $x;
    }

    public static function getDistance (float $srcX, float $srcY, float $destX, float $destY) : float {
        return sqrt(self::square($destX-$srcX) + self::square($destY - $srcY));
    }
}