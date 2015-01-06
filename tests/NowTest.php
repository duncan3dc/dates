<?php

namespace Regatta\Dates;

class NowTest extends \PHPUnit_Framework_TestCase
{

    public function testConstructor()
    {
        $unix = time();
        $date = new Now;
        $this->assertSame($unix, $date->asUnix());
    }
}
