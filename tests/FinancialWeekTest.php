<?php

namespace Regatta\Dates;

class FinancialWeekTest extends \PHPUnit_Framework_TestCase
{

    protected function assertStartTime($expected, $unix)
    {
        $date = new DateTime($unix);
        $week = new FinancialWeek($date);
        $result = $week->getStart()->timestamp();
        $this->assertSame($expected, $result);
    }
    public function testGetStart1()
    {
        $this->assertStartTime(mktime(12, 0, 0, 2, 1, 2015), mktime(12, 0, 0, 2, 1, 2015));
    }
    public function testGetStart2()
    {
        $this->assertStartTime(mktime(12, 0, 0, 2, 2, 2015), mktime(12, 0, 0, 2, 5, 2015));
    }
    public function testGetStart3()
    {
        $this->assertStartTime(mktime(12, 0, 0, 1, 25, 2016), mktime(12, 0, 0, 1, 31, 2016));
    }
    public function testGetStart4()
    {
        $this->assertStartTime(mktime(12, 0, 0, 1, 31, 2011), mktime(12, 0, 0, 1, 31, 2011));
    }


    protected function assertEndTime($expected, $unix)
    {
        $date = new DateTime($unix);
        $week = new FinancialWeek($date);
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
        $this->assertEndTime(mktime(12, 0, 0, 1, 25, 2015), mktime(12, 0, 0, 1, 25, 2015));
    }
    public function testGetEnd4()
    {
        $this->assertEndTime(mktime(12, 0, 0, 2, 7, 2016), mktime(12, 0, 0, 2, 1, 2016));
    }


    public function testNow()
    {
        $date = Date::now();
        $check = new FinancialWeek($date);
        $week = FinancialWeek::now();
        $this->assertSame($check->getStart()->timestamp(), $week->getStart()->timestamp());
        $this->assertSame($check->getEnd()->timestamp(), $week->getEnd()->timestamp());
    }


    public function testFromInt()
    {
        $week = FinancialWeek::fromInt(2014, 51);

        $this->assertSame(51, $week->getStart()->getFinancialWeek());
        $this->assertSame(51, $week->getEnd()->getFinancialWeek());
    }


    public function testGetFinancialWeek1()
    {
        $week = new FinancialWeek(Date::mkdate(2015, 1, 31));
        $this->assertSame(53, $week->getFinancialWeek());
    }


    public function testGetFinancialWeek2()
    {
        $week = new FinancialWeek(Date::mkdate(2015, 2, 1));
        $this->assertSame(1, $week->getFinancialWeek());
    }
}
