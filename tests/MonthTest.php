<?php

namespace duncan3dc\DateTests;

use duncan3dc\Dates\Date;
use duncan3dc\Dates\DateTime;
use duncan3dc\Dates\Month;
use PHPUnit\Framework\TestCase;

class MonthTest extends TestCase
{
    protected function assertStartTime($expected, $unix)
    {
        $date = new DateTime($unix);
        $month = new Month($date);
        $result = $month->getStart()->timestamp();
        $this->assertSame($expected, $result);
    }
    public function testGetStart1(): void
    {
        $this->assertStartTime(mktime(12, 0, 0, 2, 1, 2015), mktime(12, 0, 0, 2, 27, 2015));
    }
    public function testGetStart2(): void
    {
        $this->assertStartTime(mktime(12, 0, 0, 7, 1, 2015), mktime(12, 0, 0, 7, 1, 2015));
    }
    public function testGetStart3(): void
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
    public function testGetEnd1(): void
    {
        $this->assertEndTime(mktime(12, 0, 0, 7, 31, 2014), mktime(12, 0, 0, 7, 15, 2014));
    }
    public function testGetEnd2(): void
    {
        $this->assertEndTime(mktime(12, 0, 0, 2, 29, 2012), mktime(12, 0, 0, 2, 28, 2012));
    }
    public function testGetEnd3(): void
    {
        $this->assertEndTime(mktime(12, 0, 0, 6, 30, 2015), mktime(12, 0, 0, 5, 32, 2015));
    }


    public function testNow(): void
    {
        $date = Date::now();
        $check = new Month($date);
        $month = Month::now();
        $this->assertSame($check->getStart()->timestamp(), $month->getStart()->timestamp());
        $this->assertSame($check->getEnd()->timestamp(), $month->getEnd()->timestamp());
    }


    public function assertRelativeTimes($start, $end, Month $month)
    {
        $this->assertSame($start, $month->getStart()->timestamp());
        $this->assertSame($end, $month->getEnd()->timestamp());
    }
    public function testAddMonths(): void
    {
        $month = new Month(Date::mkdate(2015, 6, 1));
        $month = $month->addMonths(2);

        $this->assertRelativeTimes(mktime(12, 0, 0, 8, 1, 2015), mktime(12, 0, 0, 8, 31, 2015), $month);
    }
    public function testSubMonths(): void
    {
        $month = new Month(Date::mkdate(2015, 1, 1));
        $month = $month->subMonths(1);

        $this->assertRelativeTimes(mktime(12, 0, 0, 12, 1, 2014), mktime(12, 0, 0, 12, 31, 2014), $month);
    }
    public function testAddYears(): void
    {
        $month = new Month(Date::mkdate(2015, 6, 1));
        $month = $month->addYears(2);

        $this->assertRelativeTimes(mktime(12, 0, 0, 6, 1, 2017), mktime(12, 0, 0, 6, 30, 2017), $month);
    }
    public function testSubYears(): void
    {
        $month = new Month(Date::mkdate(2015, 1, 1));
        $month = $month->subYears(1);

        $this->assertRelativeTimes(mktime(12, 0, 0, 1, 1, 2014), mktime(12, 0, 0, 1, 31, 2014), $month);
    }
}
