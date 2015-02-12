<?php

namespace Regatta\Dates;

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


    public function testInvalidRange()
    {
        $date = Date::now();
        $this->setExpectedException("InvalidArgumentException", "Invalid range, the start date must be before the end date");
        $range = new Range($date, $date->subDays(1));
    }
}
