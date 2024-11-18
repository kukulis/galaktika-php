<?php

namespace Galaktika\Various\Geometry;

class Line
{

    public const EPSILON = 0.0001;

    private Point $anchor;

    private float $angle;

    public function getAnchor(): Point
    {
        return $this->anchor;
    }

    public function setAnchor(Point $anchor): Line
    {
        $this->anchor = $anchor;
        return $this;
    }

    public function getAngle(): float
    {
        return $this->angle;
    }

    public function setAngle(float $angle): Line
    {
        $this->angle = $angle;
        return $this;
    }

    public static function offTwoPoints(Point $a, Point $b) : Line  {
        $line = new Line();
        $line->setAnchor($a);

        if ( ($b->x - $a->x) > self::EPSILON) {
            $tangent = ($b->y - $a->y) / ($b->x - $a->x);

        }
        elseif(($b->y - $a->y)) {

        }
    }


}