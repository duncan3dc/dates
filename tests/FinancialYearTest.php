<?php

namespace Regatta\Dates;

class FinancialYearTest extends \PHPUnit_Framework_TestCase
{

    protected function assertStartTime($expected, $unix)
    {
        $date = new DateTime($unix);
        $year = new FinancialYear($date);
        $result = $year->getStart()->timestamp();
        $this->assertSame($expected, $result);
    }
    public function testGetStart1()
    {
        $this->assertStartTime(mktime(12, 0, 0, 2, 1, 2015), mktime(12, 0, 0, 2, 1, 2015));
    }
    public function testGetStart2()
    {
        $this->assertStartTime(mktime(12, 0, 0, 2, 1, 2015), mktime(12, 0, 0, 7, 31, 2015));
    }
    public function testGetStart3()
    {
        $this->assertStartTime(mktime(12, 0, 0, 2, 1, 2015), mktime(12, 0, 0, 8, 1, 2015));
    }
    public function testGetStart4()
    {
        $this->assertStartTime(mktime(12, 0, 0, 2, 1, 2014), mktime(12, 0, 0, 1, 31, 2015));
    }


    protected function assertEndTime($expected, $unix)
    {
        $date = new DateTime($unix);
        $year = new FinancialYear($date);
        $result = $year->getEnd()->timestamp();
        $this->assertSame($expected, $result);
    }
    public function testGetEnd1()
    {
        $this->assertEndTime(mktime(12, 0, 0, 1, 31, 2015), mktime(12, 0, 0, 2, 1, 2014));
    }
    public function testGetEnd2()
    {
        $this->assertEndTime(mktime(12, 0, 0, 1, 31, 2015), mktime(12, 0, 0, 7, 31, 2014));
    }
    public function testGetEnd3()
    {
        $this->assertEndTime(mktime(12, 0, 0, 1, 31, 2015), mktime(12, 0, 0, 8, 1, 2014));
    }
    public function testGetEnd4()
    {
        $this->assertEndTime(mktime(12, 0, 0, 1, 31, 2015), mktime(12, 0, 0, 1, 31, 2015));
    }


    public function testNow()
    {
        $date = Date::now();
        $check = new FinancialYear($date);
        $year = FinancialYear::now();
        $this->assertSame($check->getStart()->timestamp(), $year->getStart()->timestamp());
        $this->assertSame($check->getEnd()->timestamp(), $year->getEnd()->timestamp());
    }


    public function assertRelativeTimes($start, $end, FinancialYear $year)
    {
        $this->assertSame($start, $year->getStart()->timestamp());
        $this->assertSame($end, $year->getEnd()->timestamp());
    }
    public function testAddYears()
    {
        $year = new FinancialYear(Date::mkdate(2015, 2, 1));
        $year = $year->addYears(1);

        $this->assertRelativeTimes(mktime(12, 0, 0, 2, 1, 2016), mktime(12, 0, 0, 1, 31, 2017), $year);
    }
    public function testSubYears()
    {
        $year = new FinancialYear(Date::mkdate(2015, 1, 31));
        $year = $year->subYears(1);

        $this->assertRelativeTimes(mktime(12, 0, 0, 2, 1, 2013), mktime(12, 0, 0, 1, 31, 2014), $year);
    }
}
