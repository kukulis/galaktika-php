<?php

namespace Tests\Galaktika\V2\Battle;

use Galaktika\Util\SingletonsContainer;
use Galaktika\V2\Battle\BattleCalculator;
use Galaktika\V2\Battle\CyclicSequence;
use Galaktika\V2\Data\Fleet;
use Galaktika\V2\Data\Ship;
use PHPUnit\Framework\TestCase;

class BattleTest extends TestCase
{

    public function setUp(): void
    {
        parent::setUp();
        SingletonsContainer::instance()->cleanContainer();
    }

    /**
     * @dataProvider provideFleetsForBattle
     */
    public function testBattle(Fleet $fleetA, Fleet $fleetB, Fleet $expectedFleetA, Fleet $expectedFleetB)
    {
        $battleCalculator = new BattleCalculator(100);
        $randomSequence = new CyclicSequence([
            0,
            0.25,
            0.5,
            0.75,
            0.999
        ]);
        $battleReport = $battleCalculator->battle($fleetA, $fleetB, $randomSequence);

        $this->assertEquals($expectedFleetA, $battleReport->getFleetA());
        $this->assertEquals($expectedFleetB, $battleReport->getFleetB());
    }

    public static function provideFleetsForBattle(): array
    {
        return [
            'battle 2x2' => [
                'fleetA' => (new Fleet())->setShips([
                    SingletonsContainer::instance()->getSingleton('ship11', fn() => (new Ship())
                        ->setGuns(1)
                        ->setAttack(1)
                        ->setDefence(1)
                        ->setId('ship11')
                    ),
                    SingletonsContainer::instance()->getSingleton('ship12', fn() => (new Ship())
                        ->setGuns(1)
                        ->setAttack(1)
                        ->setDefence(4)
                        ->setId('ship12')
                    ),
                ]),
                'fleetB' => (new Fleet())->setShips([
                    SingletonsContainer::instance()->getSingleton('ship21', fn() => (new Ship())
                        ->setGuns(1)
                        ->setAttack(1)
                        ->setDefence(1)
                        ->setId('ship21')
                    ),
                    SingletonsContainer::instance()->getSingleton('ship22', fn() => (new Ship())
                        ->setGuns(1)
                        ->setAttack(1)
                        ->setDefence(4)
                        ->setId('ship22')
                    ),
                ]),
                'expectedFleetA' => (new Fleet())->setShips([
                    SingletonsContainer::instance()->getSingleton('ship12')
                ]),
                'expectedFleetB' => (new Fleet())->setShips([
                    SingletonsContainer::instance()->getSingleton('ship22')
                ]),
            ]
        ];
    }
}