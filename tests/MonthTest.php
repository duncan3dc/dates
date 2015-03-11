<?php

namespace Regatta\Dates;

class MonthTest extends \PHPUnit_Framework_TestCase
{

    protected function assertStartTime($expected, $unix)
    {
        $date = new DateTime($unix);
        $month = new Month($date);
        $result = $month->getStart()->timestamp();
        $this->assertSame($expected, $result);
    }
    public function testGetStart1()
    {
        $this->assertStartTime(mktime(12, 0, 0, 2, 1, 2015), mktime(12, 0, 0, 2, 27, 2015));
    }
    public function testGetStart2()
    {
        $this->assertStartTime(mktime(12, 0, 0, 7, 1, 2015), mktime(12, 0, 0, 7, 1, 2015));
    }
    public function testGetStart3()
    {
        $this->assertStartTime(mktime(12, 0, 0, 5, 1, 2015), mktime(12, 0, 0, 6, 0, 2015));
    }


    protected function assertEndTime($expected, $unix)
    {
        $date = new DateTime($unix);
        $month = new Month($date);
        $result = $month->getEnd()->timestamp();
        $this->assertSame($expected, $result);
    }
    public function testGetEnd1()
    {
        $this->assertEndTime(mktime(12, 0, 0, 7, 31, 2014), mktime(12, 0, 0, 7, 15, 2014));
    }
    public function testGetEnd2()
    {
        $this->assertEndTime(mktime(12, 0, 0, 2, 29, 2012), mktime(12, 0, 0, 2, 28, 2012));
    }
    public function testGetEnd3()
    {
        $this->assertEndTime(mktime(12, 0, 0, 6, 30, 2015), mktime(12, 0, 0, 5, 32, 2015));
    }


    public function testNow()
    {
        $date = Date::now();
        $check = new Month($date);
        $month = Month::now();
        $this->assertSame($check->getStart()->timestamp(), $month->getStart()->timestamp());
        $this->assertSame($check->getEnd()->timestamp(), $month->getEnd()->timestamp());
    }


    public function testFormatPeriod()
    {
        $unix = mktime(12, 0, 0, 1, 1, 2014);
        $date = new DateTime($unix);
        $month = new Month($date);
        $this->assertSame(13, $month->formatPeriod("y"));
    }
}
