<?php

namespace Regatta\Dates;

class TodayTest extends \PHPUnit_Framework_TestCase
{

    public function testConstructor()
    {
        $unix = time();
        $date = new Today;
        $this->assertSame($unix, $date->asUnix());
    }
}
