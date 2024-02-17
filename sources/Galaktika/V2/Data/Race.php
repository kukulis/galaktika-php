<?php

namespace Galaktika\V2\Data;

class Race
{
    private string $id;

    // TODO proxy, because has different tech in different turn
    private Technologies $technologies;

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): Race
    {
        $this->id = $id;

        return $this;
    }

    public function getTechnologies(): Technologies
    {
        return $this->technologies;
    }

    public function setTechnologies(Technologies $technologies): Race
    {
        $this->technologies = $technologies;

        return $this;
    }
}