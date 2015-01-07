<?php

namespace duncan3dc\DateTests;

use duncan3dc\Dates\Date;
use duncan3dc\Dates\Range;

class RangeTest extends \PHPUnit_Framework_TestCase
{

    public function testGetStart()
    {
        $date = Date::now();
        $range = new Range($date, $date);
        $this->assertSame($date, $range->getStart());
    }


    public function testGetEnd()
    {
        $date = Date::now();
        $range = new Range($date, $date);
        $this->assertSame($date, $range->getEnd());
    }
}
