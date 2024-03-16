<?php

namespace Tests\Unit\Various;

use PHPUnit\Framework\TestCase;

class PiETest extends TestCase
{
    public function testPiE() {

        $pi = pi();
        $e6 = exp(6);

        $piExpression = $pi*$pi*$pi*$pi + $pi*$pi*$pi*$pi*$pi;

//        $this->assertEquals($e6, $piExpression );

        $this->assertLessThan(0.00002, abs($e6-$piExpression));
    }

}