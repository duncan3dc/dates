<?php

namespace duncan3dc\DateTests;

use duncan3dc\Dates\Date;
use duncan3dc\Dates\DateTime;

class DateTest extends \PHPUnit_Framework_TestCase
{

    public function testConstructor()
    {
        $unix = time();
        $datetime = new DateTime($unix);
        $date = new Date($unix);
        $this->assertSame($datetime->midday(), $date->timestamp());
    }


    public function testNow()
    {
        $date = Date::now();
        $this->assertSame(mktime(12, 0, 0, date("n"), date("j"), date("Y")), $date->timestamp());
    }


    public function testParse()
    {
        $input = "2008-02-22";
        $result = Date::parse($input)->format("Y-m-d");
        $this->assertSame($input, $result);
    }


    public function testMkdate()
    {
        $date = Date::mkdate(2014, 6, 12);
        $this->assertSame(mktime(12, 0, 0, 6, 12, 2014), $date->timestamp());
    }
}
