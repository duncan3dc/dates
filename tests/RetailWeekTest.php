<?php

namespace Regatta\Dates;

class RetailWeekTest extends \PHPUnit_Framework_TestCase
{

    protected function assertStartTime($expected, $unix)
    {
        $date = new DateTime($unix);
        $week = new RetailWeek($date);
        $result = $week->getStart()->timestamp();
        $this->assertSame($expected, $result);
    }
    public function testGetStart1()
    {
        $this->assertStartTime(mktime(12, 0, 0, 2, 1, 2015), mktime(12, 0, 0, 2, 1, 2015));
    }
    public function testGetStart2()
    {
        $this->assertStartTime(mktime(12, 0, 0, 2, 1, 2015), mktime(12, 0, 0, 2, 5, 2015));
    }
    public function testGetStart3()
    {
        $this->assertStartTime(mktime(12, 0, 0, 1, 31, 2016), mktime(12, 0, 0, 1, 31, 2016));
    }
    public function testGetStart4()
    {
        $this->assertStartTime(mktime(12, 0, 0, 1, 30, 2011), mktime(12, 0, 0, 1, 31, 2011));
    }
    public function testGetStart5()
    {
        $this->assertStartTime(mktime(12, 0, 0, 2, 1, 2016), mktime(12, 0, 0, 2, 4, 2016));
    }


    protected function assertEndTime($expected, $unix)
    {
        $date = new DateTime($unix);
        $week = new RetailWeek($date);
        $result = $week->getEnd()->timestamp();
        $this->assertSame($expected, $result);
    }
    public function testGetEnd1()
    {
        $this->assertEndTime(mktime(12, 0, 0, 1, 31, 2015), mktime(12, 0, 0, 1, 31, 2015));
    }
    public function testGetEnd2()
    {
        $this->assertEndTime(mktime(12, 0, 0, 1, 31, 2015), mktime(12, 0, 0, 1, 26, 2015));
    }
    public function testGetEnd3()
    {
        $this->assertEndTime(mktime(12, 0, 0, 1, 31, 2015), mktime(12, 0, 0, 1, 25, 2015));
    }
    public function testGetEnd4()
    {
        $this->assertEndTime(mktime(12, 0, 0, 2, 6, 2016), mktime(12, 0, 0, 2, 1, 2016));
    }


    public function testNow()
    {
        $date = Date::now();
        $check = new RetailWeek($date);
        $week = RetailWeek::now();
        $this->assertSame($check->getStart()->timestamp(), $week->getStart()->timestamp());
        $this->assertSame($check->getEnd()->timestamp(), $week->getEnd()->timestamp());
    }


    public function testFromInt()
    {
        $week = RetailWeek::fromInt(2014, 51);

        $this->assertSame(51, $week->getStart()->getRetailWeek());
        $this->assertSame(51, $week->getEnd()->getRetailWeek());
    }


    public function testGetRetailWeek1()
    {
        $week = new RetailWeek(Date::mkdate(2016, 3, 6));
        $this->assertSame(6, $week->getRetailWeek());
    }


    public function testGetRetailWeek2()
    {
        $week = new RetailWeek(Date::mkdate(2016, 2, 1));
        $this->assertSame(1, $week->getRetailWeek());
    }
}
