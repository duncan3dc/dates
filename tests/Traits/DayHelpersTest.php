<?php

namespace duncan3dc\DateTests;

use duncan3dc\Dates\Date;

class DayHelpersTest extends \PHPUnit_Framework_TestCase
{

    public function testIsMonday()
    {
        $date = new Date(mktime(12, 0, 0, 1, 12, 2015));
        $this->assertTrue($date->isMonday());
    }


    public function testIsTuesday()
    {
        $date = new Date(mktime(12, 0, 0, 1, 13, 2015));
        $this->assertTrue($date->isTuesday());
    }


    public function testIsWednesday()
    {
        $date = new Date(mktime(12, 0, 0, 1, 14, 2015));
        $this->assertTrue($date->isWednesday());
    }


    public function testIsThursday()
    {
        $date = new Date(mktime(12, 0, 0, 1, 15, 2015));
        $this->assertTrue($date->isThursday());
    }


    public function testIsFriday()
    {
        $date = new Date(mktime(12, 0, 0, 1, 16, 2015));
        $this->assertTrue($date->isFriday());
    }


    public function testIsSaturday()
    {
        $date = new Date(mktime(12, 0, 0, 1, 17, 2015));
        $this->assertTrue($date->isSaturday());
    }


    public function testIsSunday()
    {
        $date = new Date(mktime(12, 0, 0, 1, 18, 2015));
        $this->assertTrue($date->isSunday());
    }


    public function testIsWeekend()
    {
        $date = new Date(mktime(12, 0, 0, 1, 18, 2015));
        $this->assertTrue($date->isWeekend());
    }


    public function testIsWeekday()
    {
        $date = new Date(mktime(12, 0, 0, 1, 14, 2015));
        $this->assertTrue($date->isWeekday());
    }
}
