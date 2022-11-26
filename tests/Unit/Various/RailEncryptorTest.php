<?php

namespace Tests\Unit\Util\Various;

use Galaktika\Various\RailEncryptor;
use PHPUnit\Framework\TestCase;

class RailEncryptorTest extends TestCase
{

    public function testSample() {
        $this->assertSame("Hoo!el,Wrdl l", RailEncryptor::encodeRailFenceCipher("Hello, World!", 3));
        $this->assertSame("Hello, World!", RailEncryptor::decodeRailFenceCipher("Hoo!el,Wrdl l", 3));

        $this->assertSame(RailEncryptor::encodeRailFenceCipher("", 3), "");
        $this->assertSame(RailEncryptor::decodeRailFenceCipher("", 3), "");

        $this->assertSame(RailEncryptor::encodeRailFenceCipher("WEAREDISCOVEREDFLEEATONCE", 3), "WECRLTEERDSOEEFEAOCAIVDEN");
        $this->assertSame(RailEncryptor::decodeRailFenceCipher("WECRLTEERDSOEEFEAOCAIVDEN", 3), "WEAREDISCOVEREDFLEEATONCE");
    }
}