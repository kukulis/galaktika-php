<?php

namespace Galaktika\Various\Geometry;

use RuntimeException;

class Vector
{
    const EPSILON = 0.0001;

    public float $x, $y;

    public function __construct(float $x, float $y)
    {
        $this->x = $x;
        $this->y = $y;
    }

    public static function ofTwoPoints(Point $a, Point $b): Vector
    {
        return new Vector($b->x - $a->x, $b->y - $a->y);
    }

    public function getAngle(): float
    {
        if ($this->x < self::EPSILON && $this->y < self::EPSILON) {
            throw new RuntimeException('Cant calculate angle of a zero vector');
        }

        if ($this->x > self::EPSILON) {
            return atan($this->y / $this->x);
        }

        return M_PI_2 - atan ( $this->x / $this->y);
    }
}