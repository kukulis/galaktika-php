<?php

namespace Galaktika\V2\Math;

use Galaktika\Exceptions\GalaktikaException;

class DestroyCalculator
{
    public static function calculateDestroyed(float $attack, float $defence, float $randomFactor): bool
    {
        $normAttack = $attack / ($attack + $defence);
        $normDefence = $defence / ($attack + $defence);

        if ($normAttack < 0.2) {
            return false;
        }

        if ($normDefence < 0.2) {
            return true;
        }

        $renormAttack = ($normAttack - 0.2) / ($normAttack + $normDefence - 0.4);
        $renormDefence = ($normDefence - 0.2) / ($normAttack + $normDefence - 0.4);

        if (abs($renormAttack + $renormDefence - 1) > 0.0001) {
            throw new GalaktikaException(
                sprintf(
                    'Wrong normalized attack %s and defence %s, together %s',
                    $renormAttack,
                    $renormDefence,
                    $renormAttack + $renormDefence
                )
            );
        }

        return ($renormDefence <= $randomFactor);
    }
}