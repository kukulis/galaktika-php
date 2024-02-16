<?php

namespace Tests\Galaktika\V2\Production;

use Galaktika\V2\Data\PlanetSurface;
use Galaktika\V2\Data\Race;
use Galaktika\V2\Data\Technologies;
use Galaktika\V2\Production\ResearchCommand;
use PHPUnit\Framework\TestCase;

class TechnologiesCommandTest extends TestCase
{
    public function testUpgrade()
    {
        $technologies = new Technologies();
        $owner = new Race();
        $owner->setTechnologies($technologies);
        $planetSurface = new PlanetSurface();
        $planetSurface->setOwner($owner);

        $planetSurface->setPopulation(100);
        $planetSurface->setIndustry(100);

        $researchCommand = new ResearchCommand();

        $researchCommand->setGoalAmount(100);
        $researchCommand->setTechnologyType(Technologies::TYPE_ENGINES);

        $rezPlanetSurface = clone $planetSurface;
        $researchCommand->execute($rezPlanetSurface, $planetSurface);

        $this->assertEquals(2, $rezPlanetSurface->getOwner()->getTechnologies()->getEngines());
    }
}