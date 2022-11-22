<?php

namespace Tests\Unit\Util\Various;

use Galaktika\Various\WordsSpinner;
use PHPUnit\Framework\TestCase;

class SpinnedTest extends TestCase
{
    public function testBasicTests() {
        $this->assertSame("emocleW", WordsSpinner::spinWords("Welcome"));
        $this->assertSame("Hey wollef sroirraw", WordsSpinner::spinWords("Hey fellow warriors"));
        $this->assertSame("This is a test", WordsSpinner::spinWords("This is a test"));
        $this->assertSame("This is rehtona test", WordsSpinner::spinWords("This is another test"));
        $this->assertSame("You are tsomla to the last test", WordsSpinner::spinWords("You are almost to the last test"));
        $this->assertSame("Just gniddik ereht is llits one more", WordsSpinner::spinWords("Just kidding there is still one more"));
        $this->assertSame("ylsuoireS this is the last one", WordsSpinner::spinWords("Seriously this is the last one"));
    }
}