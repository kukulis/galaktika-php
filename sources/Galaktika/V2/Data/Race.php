<?php

namespace Galaktika\V2\Data;

class Race
{
    private string $id;

    private ?TechnologiesTurnProxy $technologiesTurnProxy = null;

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
        return $this->getTechnologiesProxy()->get();
    }

    public function setTechnologies(Technologies $technologies): Race
    {
        $this->getTechnologiesProxy()->set($technologies);

        return $this;
    }

    public function getTechnologiesProxy(): TechnologiesTurnProxy
    {
        if ($this->technologiesTurnProxy === null) {
            $this->technologiesTurnProxy = new TechnologiesTurnProxy();
        }

        return $this->technologiesTurnProxy;
    }
}