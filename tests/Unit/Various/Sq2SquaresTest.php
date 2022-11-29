<?php

namespace Tests\Unit\Util\Various;

use Galaktika\Various\Sq2Squares;
use PHPUnit\Framework\TestCase;

class Sq2SquaresTest extends TestCase
{

//    function revTest($n, $exp) {
//        $ans = Sq2Squares::decompose($n);
//        $success = false;
//        $sans = json_encode($ans);
//        $sexp = json_encode($exp);
//        echo("Expected: $sexp  Got:  $sans\n");
//        if ($ans == $exp) {
//            echo("Good\n");
//            $success = true;
//        } else {
//            if ($ans == null) {
//                $success = false;
//            } else {
//                $st = isSorted($ans);
//                $t = sumSquares($ans, $n);
//                echo("Sorted: $st Total: $t\n");
//                if (($st == false) || ($t == false)) {
//                    echo("Not increasinly sorted or bad sum of squares\n");
//                    $success = false;
//                }
//                else { $success = true; echo("Good\n");}
//            }
//        }
//        $this->assertSame($success, true);
//    }
    public function testBasic()
    {
        $decomposeArray = Sq2Squares::decompose(50);
        $this->assertEquals([1, 3, 5, 8, 49], $decomposeArray);
        $this->assertEquals([2, 3, 5, 7, 43], Sq2Squares::decompose(44));
        $this->assertEquals(null, Sq2Squares::decompose(2));
    }

}
