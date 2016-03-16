<?php

namespace Regatta\Dates;

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


    public function testWithHours()
    {
        $date = Date::mkdate(2016, 2, 20);
        $date = $date->withHours(10);
        $this->assertInstanceOf(DateTime::class, $date);
        $this->assertSame("2016-02-20 10:00:00", $date->format("Y-m-d H:i:s"));
    }


    public function testWithMinutes()
    {
        $date = Date::mkdate(2016, 2, 20);
        $date = $date->withMinutes(10);
        $this->assertInstanceOf(DateTime::class, $date);
        $this->assertSame("2016-02-20 12:10:00", $date->format("Y-m-d H:i:s"));
    }


    public function testWithSeconds()
    {
        $date = Date::mkdate(2016, 2, 20);
        $date = $date->withSeconds(10);
        $this->assertInstanceOf(DateTime::class, $date);
        $this->assertSame("2016-02-20 12:00:10", $date->format("Y-m-d H:i:s"));
    }
}
