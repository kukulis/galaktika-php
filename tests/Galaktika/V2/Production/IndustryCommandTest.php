<?php

namespace Tests\Galaktika\V2\Production;

use Galaktika\V2\Data\Planet;
use Galaktika\V2\Data\PlanetSurface;
use Galaktika\V2\Production\IndustryCommand;
use PHPUnit\Framework\TestCase;

class IndustryCommandTest extends TestCase
{
    /**
     * @dataProvider provide
     */
    public function testIndustry(PlanetSurface $surface, IndustryCommand $command, PlanetSurface $expectedSurface)
    {
        $rezPlanetSurface =  clone $surface;
        $command->execute($rezPlanetSurface, $surface, 2);

        $this->assertEquals($expectedSurface->getIndustry(), $rezPlanetSurface->getIndustry());
        $this->assertEquals($expectedSurface->getPopulation(), $rezPlanetSurface->getPopulation());
        $this->assertEquals($expectedSurface->getMaterial(), $rezPlanetSurface->getMaterial());
        $this->assertEquals($expectedSurface->getUsedIndustry(), $rezPlanetSurface->getUsedIndustry());
        $this->assertEquals($expectedSurface->getUsedPopulation(), $rezPlanetSurface->getUsedPopulation());
    }

    public function provide(): array
    {
        return [
            'test 0' => [
                'surface' => (new PlanetSurface())
                    ->setPlanet((new Planet())->setSize(100))
                    ->setIndustry(100)
                    ->setMaterial(0)
                    ->setPopulation(100)
                ,
                'command' => (new IndustryCommand())
                    ->setGoalAmount(0)
                ,
                'expectedSurface' => (new PlanetSurface())
                    ->setIndustry(100)
                    ->setPopulation(100)
                    ->setMaterial(0)
                    ->setUsedIndustry(0)
                    ->setUsedPopulation(0),
            ],
            'test from material' => [
                'surface' => (new PlanetSurface())
                    ->setPlanet((new Planet())->setSize(100))
                    ->setIndustry(50)
                    ->setMaterial(55)
                    ->setPopulation(100)
                ,
                'command' => (new IndustryCommand())
                    ->setGoalAmount(50)
                ,
                'expectedSurface' => (new PlanetSurface())
                    ->setIndustry(100)
                    ->setPopulation(100)
                    ->setMaterial(5)
                    ->setUsedIndustry(0)
                    ->setUsedPopulation(50),
            ],
            'test from material exceeding planet' => [
                'surface' => (new PlanetSurface())
                    ->setPlanet((new Planet())->setSize(100))
                    ->setIndustry(50)
                    ->setMaterial(55)
                    ->setPopulation(100)
                ,
                'command' => (new IndustryCommand())
                    ->setGoalAmount(55)
                ,
                'expectedSurface' => (new PlanetSurface())
                    ->setIndustry(100)
                    ->setPopulation(100)
                    ->setMaterial(5)
                    ->setUsedIndustry(0)
                    ->setUsedPopulation(50),
            ],
            'test from material and industry' => [
                'surface' => (new PlanetSurface())
                    ->setPlanet((new Planet())->setSize(100))
                    ->setIndustry(45)
                    ->setMaterial(50)
                    ->setPopulation(100)
                ,
                'command' => (new IndustryCommand())
                    ->setGoalAmount(55)
                ,
                'expectedSurface' => (new PlanetSurface())
                    ->setIndustry(100)
                    ->setPopulation(100)
                    ->setMaterial(0)
                    ->setUsedIndustry(5)
                    ->setUsedPopulation(55),
            ],
            'test from industry small' => [
                'surface' => (new PlanetSurface())
                    ->setPlanet((new Planet())->setSize(100))
                    ->setIndustry(45)
                    ->setMaterial(0)
                    ->setPopulation(100)
                ,
                'command' => (new IndustryCommand())
                    ->setGoalAmount(5)
                ,
                'expectedSurface' => (new PlanetSurface())
                    ->setIndustry(50)
                    ->setPopulation(100)
                    ->setMaterial(0)
                    ->setUsedIndustry(5)
                    ->setUsedPopulation(5),
            ],
        ];
    }
}