<?php

namespace Galaktika\V2\Data;

use Galaktika\Exceptions\GalaktikaException;

class Technologies
{
    const TYPE_ENGINES = 'ENGINES';
    const TYPE_DEFENCE = 'DEFENCE';
    const TYPE_ATTACK = 'ATTACK';
    const TYPE_CARGO = 'CARGO';

    private float $engines = 1;
    private float $defence = 1;
    private float $attack = 1;
    private float $cargo = 1;

    public function getEngines(): float
    {
        return $this->engines;
    }

    public function setEngines(float $engines): Technologies
    {
        $this->engines = $engines;

        return $this;
    }

    public function getDefence(): float
    {
        return $this->defence;
    }

    public function setDefence(float $defence): Technologies
    {
        $this->defence = $defence;

        return $this;
    }

    public function getAttack(): float
    {
        return $this->attack;
    }

    public function setAttack(float $attack): Technologies
    {
        $this->attack = $attack;

        return $this;
    }

    public function getCargo(): float
    {
        return $this->cargo;
    }

    public function setCargo(float $cargo): Technologies
    {
        $this->cargo = $cargo;

        return $this;
    }

    public function setTechnology(string $type, float $value): self
    {
        switch ($type) {
            case self::TYPE_ATTACK:
                $this->attack = $value;
                break;
            case self::TYPE_CARGO:
                $this->cargo = $value;
                break;
            case self::TYPE_DEFENCE:
                $this->defence = $value;
                break;
            case self::TYPE_ENGINES:
                $this->engines = $value;
                break;
            default:
                throw new GalaktikaException(sprintf('Wrong technology type %s', $type));
        }

        return $this;
    }

    public function getTechnology(string $type): float
    {
        switch ($type) {
            case self::TYPE_ATTACK:
                return $this->attack;
            case self::TYPE_CARGO:
                return $this->cargo;
            case self::TYPE_DEFENCE:
                return $this->defence;
            case self::TYPE_ENGINES:
                return $this->engines;
            default:
                throw new GalaktikaException(sprintf('Wrong technology type %s', $type));
        }
    }

}