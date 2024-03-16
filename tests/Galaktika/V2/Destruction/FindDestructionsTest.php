<?php

namespace Tests\Galaktika\V2\Destruction;

use Galaktika\Util\SingletonsContainer;
use Galaktika\V2\Battle\Destruction;
use Galaktika\V2\Data\DiplomacyMap;
use Galaktika\V2\Data\Location;
use Galaktika\V2\Data\Planet;
use Galaktika\V2\Data\PlanetSurface;
use Galaktika\V2\Data\Race;
use Galaktika\V2\Data\Ship;
use Galaktika\V2\Space\DestructionFinder;
use PHPUnit\Framework\TestCase;

class FindDestructionsTest extends TestCase
{
    /**
     * @param Ship[] $ships
     * @param PlanetSurface[] $surfaces
     * @param Destruction[] $expectedDestructions
     * @dataProvider provideDataForDestructions
     */
    public function testFindDestructions(
        array $ships,
        array $surfaces,
        DiplomacyMap $diplomacyMap,
        array $expectedDestructions
    ) {
        $destructions = DestructionFinder::findDesctructions($ships, $surfaces, $diplomacyMap);

        $this->assertEquals($expectedDestructions, $destructions);
    }

    public static function provideDataForDestructions(): array
    {
        return [
            'test1' => [
                'ships' => [
                    SingletonsContainer::instance()->getSingleton(
                        'ship1',
                        fn() => (new Ship())
                            ->setId('ship1')
                            ->setX(10)
                            ->setY(10)
                            ->setOwner((new Race())->setId('race1'))
                    )
                ],
                'surfaces' => [
                    SingletonsContainer::instance()->getSingleton(
                        'surface1',
                        fn() => (new PlanetSurface())
                            ->setId('surface1')
                            ->setPlanet(
                                (new Planet())
                                    ->setId('planet1')
                                    ->setLocation((new Location())->setX(10)->setY(10))

                            )
                            ->setOwner((new Race())->setId('race2'))
                    )
                ],
                'diplomacyMap' => (new DiplomacyMap()),
                'expectedDestructions' => [
                    (new Destruction())->setPlanetSurface(SingletonsContainer::instance()->getSingleton('surface1'))
                        ->setShips([SingletonsContainer::instance()->getSingleton('ship1')])
                ]
            ]
        ];
    }

}