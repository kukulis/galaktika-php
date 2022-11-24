<?php

namespace Tests\Unit\Util\Various;

use Galaktika\Various\PangramDetector;
use PHPUnit\Framework\TestCase;

class PangramDetectorTest extends TestCase
{
    public function testBasicTests() {
        # Pangrams:
        $result4 = PangramDetector::detect_pangram("The quick brown fox jumps over the lazy dog.");
        $this->assertSame(true, $result4);
        $result5 = PangramDetector::detect_pangram("1L%r+f4G!e7w V z q6M h4d F3b+t O2n e K^g+c#S^i4i X7c-u P5d7j Y6a(a B");
        $this->assertSame(true, $result5);

        # Not pangrams:
        $result1 = PangramDetector::detect_pangram("A pangram is a sentence that contains every single letter of the alphabet at least once.");
        $this->assertSame(false, $result1 );
        $result2 = PangramDetector::detect_pangram("5B!e i J x*p F h d!A:o q D y n6L%u9i.G9f2g4C a h+K!m+z:R t!j:B w s C");
        $this->assertSame(false, $result2);
    }
}