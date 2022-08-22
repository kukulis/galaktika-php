<?php

namespace Galaktika\Data;

class Movement
{
    public const BIG_EPSILON = 0.01;

    private Location $location;
    private Location $newLocation;

    private ?Vector $one = null;
    private ?float $yOnAxisX = null;
    private ?float $xOnAxisY = null;


    public function sameLine(Movement $movement): bool
    {

        $axisKeyMine = $this->getAxisKey();
        if  ($this->one->length() == 0 ) {
            return false;
        }
        $axisKeyOther = $movement->getAxisKey();

        return $axisKeyMine == $axisKeyOther;
    }

    public function overlaps(Movement $movement): bool
    {
        if (!$this->sameLine($movement)) {
            return false;
        }

        if ($this->one->getX() > $this->one->getY()) {
            return self:: between(
                $this->location->getX(),
                $this->newLocation->getX(),
                $movement->getLocation()->getX(),
                $movement->getNewLocation()->getX()
            );
        } else {
            return self:: between(
                $this->location->getY(),
                $this->newLocation->getY(),
                $movement->getLocation()->getY(),
                $movement->getNewLocation()->getY()
            );
        }
    }

    public static function between(float $from1, float $to1, float $from2, float $to2): bool
    {
        $min1 = min($from1, $to1);
        $max1 = max($from1, $to1);
        $min2 = min($from2, $to2);
        $max2 = max($from2, $to2);

        return $min1 < $max2 && $min2 < $max1;
    }

    public function meetingPoint(Movement $movement): ?Location
    {
        // simplified version
        // we will take the middle of the overlapping interval.
        // 1) calculate overlapping interval
        // 1.1) normalize dirrections
        $from1X = min($this->location->getX(), $this->newLocation->getX());
        $to1X = max($this->location->getX(), $this->newLocation->getX());
        $from2X = min($movement->getLocation()->getX(), $movement->getNewLocation()->getX());
        $to2X = max($movement->getLocation()->getX(), $movement->getNewLocation()->getX());

        $from1Y = min($this->location->getY(), $this->newLocation->getY());
        $to1Y = max($this->location->getY(), $this->newLocation->getY());
        $from2Y = min($movement->getLocation()->getY(), $movement->getNewLocation()->getY());
        $to2Y = max($movement->getLocation()->getY(), $movement->getNewLocation()->getY());

        $overlapFromX = max($from1X, $from2X);
        $overlapToX = min($to1X, $to2X);
        $overlapFromY = max($from1Y, $from2Y);
        $overlapToY = min($to1Y, $to2Y);

        $meetingPoint = new Location();

        $meetingPoint->setX(($overlapFromX + $overlapToX) / 2);
        $meetingPoint->setY(($overlapFromY + $overlapToY) / 2);

        return $meetingPoint;
    }

    public function getLocation(): Location
    {
        return $this->location;
    }

    public function setLocation(Location $location): Movement
    {
        $this->location = $location;

        return $this;
    }

    public function getNewLocation(): Location
    {
        return $this->newLocation;
    }

    public function setNewLocation(Location $newLocation): Movement
    {
        $this->newLocation = $newLocation;

        return $this;
    }

    public function getOne(): ?Vector
    {
        return $this->one;
    }

    public function calculateLines(): void
    {
        $this->one = $this->location->vector($this->newLocation)->one();

        if (abs($this->one->getX()) < self::BIG_EPSILON) {
            $this->yOnAxisX = null;
        } else {
            $tangent = $this->one->getY() / $this->one->getX();
            $this->yOnAxisX = $this->location->getY() - $this->location->getX() * $tangent;
        }

        if (abs($this->one->getY()) < self::BIG_EPSILON) {
            $this->xOnAxisY = null;
        } else {
            $cotangent = $this->one->getX() / $this->one->getY();
            $this->xOnAxisY = $this->location->getX() - $this->location->getY() * $cotangent;
        }
    }

    public function getYOnAxisX(): ?float
    {
        return $this->yOnAxisX;
    }

    public function getXOnAxisY(): ?float
    {
        return $this->xOnAxisY;
    }

    public function getAxisKey(): string
    {
        if ($this->one == null) {
            $this->calculateLines();
        }

        $directionYNormalized = $this->one->getY();
        if ($this->one->getX() < 0 || $this->one->getX() == 0 && $directionYNormalized < 0) {
            $directionYNormalized = -$directionYNormalized;
        }

        return sprintf("%0.5f;%0.5f;%0.5f", $directionYNormalized, $this->xOnAxisY, $this->yOnAxisX);
    }

    public static function build(Location $location, Location $newLocation): Movement
    {
        $movement = new Movement();

        $movement->setLocation($location);
        $movement->setNewLocation($newLocation);

        return $movement;
    }
}