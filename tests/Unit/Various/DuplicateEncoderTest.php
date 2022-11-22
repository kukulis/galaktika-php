<?php

namespace Tests\Unit\Util\Various;

use Galaktika\Various\DuplicateEncoder;
use PHPUnit\Framework\TestCase;

class DuplicateEncoderTest extends TestCase
{

    public function testBasics() {
        $this->assertSame('(((', DuplicateEncoder::duplicate_encode('din'));
        $this->assertSame('()()()', DuplicateEncoder::duplicate_encode('recede'));
        $this->assertSame(')())())', DuplicateEncoder::duplicate_encode('Success'), 'should ignore case');
        $this->assertSame('))))))', DuplicateEncoder::duplicate_encode('iiiiii'), 'duplicate-only-string');
        $this->assertSame(')))))(', DuplicateEncoder::duplicate_encode(' ( ( )'));
    }
}