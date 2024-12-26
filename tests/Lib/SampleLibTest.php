<?php
namespace Test\Lib;

use PHPUnit\Framework\TestCase;
use App\Lib\SampleLib;

/**
 * Test case for SampleLib class.
 *
 * @author  Andrew Norman
 */
class SampleLibTest extends TestCase
{
    /**
     * Test the addSample function.
     *
     * @return  void
     */
    public function testAddSample()
    {
        $arg1 = 5;
        $arg2 = 7;
        $expected = 12;

        $sampleLibObj = new SampleLib();
        $result = $sampleLibObj->addSample($arg1, $arg2);

        $this->assertEquals(
            $expected,
            $result,
            'Asserting that result returns correct value.'
        );
    }
}
