<?php

namespace Test\Draft;

use PHPUnit\Framework\TestCase;

class TestUniqid extends TestCase
{
    public function testUniqid() {
        $id1=uniqid();
        $id2=uniqid();

        $this->assertNotEquals($id1, $id2);

        echo sprintf("%s %s", $id1, $id2 );
    }

}