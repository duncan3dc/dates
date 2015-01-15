<?php

namespace Regatta\Dates;

class TodayTest extends \PHPUnit_Framework_TestCase
{

    public function testConstructor()
    {
        $date = new Today;
        $this->assertSame(mktime(12, 0, 0, date("n"), date("j"), date("Y")), $date->asUnix());
    }
}
