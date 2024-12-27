<?php

namespace Tests\Galaktika\V2\Space;

use Galaktika\V2\Data\Fleet;
use Galaktika\V2\Data\Location;
use Galaktika\V2\Data\Ship;
use Galaktika\V2\Space\FlyCalculator;
use PHPUnit\Framework\TestCase;

class FlyTest extends TestCase
{
    /**
     * @dataProvider provide
     */
    public function testFly(
        $direction,
        $speed,
        $startX,
        $startY,
        $destX,
        $destY
    )
    {
        $fleet = new Fleet();
        $ship = new Ship();
        $ship->setSpeed($speed);
        $fleet->addShip($ship);
        $fleet->setDirection($direction);

        $fleet->setLocation((new Location())->setX($startX)->setY($startY));

        $resultFleet = FlyCalculator::flyFleet($fleet);

        $this->assertEquals($destX, $resultFleet->getLocation()->getX());
        $this->assertEquals($destY, $resultFleet->getLocation()->getY());
    }

    public function provide(): array
    {
        return [
            'test1' => [
                'direction' => 0,
                'speed' => 1,
                'startX' => 0,
                'startY' => 0,
                'destX' => 1,
                'destY' => 0,
            ],
            'test2' => [
                'direction' => pi() / 2,
                'speed' => 1,
                'startX' => 0,
                'startY' => 0,
                'destX' => 0,
                'destY' => 1,
            ],
            'test3' => [
                'direction' => pi(),
                'speed' => 1,
                'startX' => 0,
                'startY' => 0,
                'destX' => -1,
                'destY' => 0,
            ],
            'test4' => [
                'direction' => pi() * 3 / 2,
                'speed' => 1,
                'startX' => 0,
                'startY' => 0,
                'destX' => 0,
                'destY' => -1,
            ],
        ];
    }

    /**
     * @dataProvider provideTestsWithDestinatedLocations
     */
    public function testWithDestinationLocation(
        Location $startLocation,
        Location $targetLocation,
        Location $expectedLocation,
        float    $speed
    )
    {
        $fleet = new Fleet();
        $fleet->addShip((new Ship())->setSpeed($speed));

        $fleet->setLocation($startLocation);
        $fleet->setTargetLocation($targetLocation);

        $fleet->setDirection(FlyCalculator::calculateDirection($startLocation, $targetLocation));

        $newFleet = FlyCalculator::flyFleet($fleet);
        $this->assertNotEquals($fleet, $newFleet);
        $this->assertEquals($expectedLocation, $newFleet->getLocation());
    }

    public static function provideTestsWithDestinatedLocations(): array
    {
        return [
            'test1' => [
                'startLocation' => (new Location())->setX(0)->setY(0),
                'targetLocation' => (new Location())->setX(2)->setY(0),
                'expectedLocation' => (new Location())->setX(1)->setY(0),
                'speed' => 1,
            ],
            'test diagonal' => [
                'startLocation' => (new Location())->setX(0)->setY(0),
                'targetLocation' => (new Location())->setX(1)->setY(1),
                'expectedLocation' => (new Location())->setX(0.70710678118655)->setY(0.70710678118655),
                'speed' => 1,
            ],
            'test II quarter no limit' => [
                'startLocation' => (new Location())->setX(0)->setY(0),
                'targetLocation' => (new Location())->setX(-4)->setY(3),
                'expectedLocation' => (new Location())->setX(-0.8)->setY(0.6),
                'speed' => 1,
            ],
            'test III quarter no limit' => [
                'startLocation' => (new Location())->setX(0)->setY(0),
                'targetLocation' => (new Location())->setX(-4)->setY(-3),
                'expectedLocation' => (new Location())->setX(-0.8)->setY(-0.6),
                'speed' => 1,
            ],
            'test IV quarter no limit' => [
                'startLocation' => (new Location())->setX(0)->setY(0),
                'targetLocation' => (new Location())->setX(4)->setY(-3),
                'expectedLocation' => (new Location())->setX(0.8)->setY(-0.6),
                'speed' => 1,
            ],
            'test I quarter limit' => [
                'startLocation' => (new Location())->setX(0)->setY(0),
                'targetLocation' => (new Location())->setX(4)->setY(3),
                'expectedLocation' => (new Location())->setX(4)->setY(3),
                'speed' => 10,
            ],
            'test II quarter limit' => [
                'startLocation' => (new Location())->setX(0)->setY(0),
                'targetLocation' => (new Location())->setX(-4)->setY(3),
                'expectedLocation' => (new Location())->setX(-4)->setY(3),
                'speed' => 10,
            ],
            'test III quarter limit' => [
                'startLocation' => (new Location())->setX(0)->setY(0),
                'targetLocation' => (new Location())->setX(-4)->setY(-3),
                'expectedLocation' => (new Location())->setX(-4)->setY(-3),
                'speed' => 10,
            ],
            'test IV quarter limit' => [
                'startLocation' => (new Location())->setX(0)->setY(0),
                'targetLocation' => (new Location())->setX(4)->setY(-3),
                'expectedLocation' => (new Location())->setX(4)->setY(-3),
                'speed' => 10,
            ],
        ];
    }
}