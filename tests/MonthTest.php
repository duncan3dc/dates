<?php

namespace duncan3dc\DateTests;

use duncan3dc\Dates\Date;
use duncan3dc\Dates\DateTime;
use duncan3dc\Dates\Month;
use PHPUnit\Framework\TestCase;

final class MonthTest extends TestCase
{
    private function assertStartTime(int $expected, int $unix): void
    {
        $date = new DateTime($unix);
        $month = new Month($date);
        $result = $month->getStart()->timestamp();
        $this->assertSame($expected, $result);
    }
    public function testGetStart1(): void
    {
        $this->assertStartTime(testtime(2015, 2, 1), testtime(2015, 2, 27));
    }
    public function testGetStart2(): void
    {
        $this->assertStartTime(testtime(2015, 7, 1), testtime(2015, 7, 1));
    }
    public function testGetStart3(): void
    {
        $this->assertStartTime(testtime(2015, 5, 1), testtime(2015, 6, 0));
    }


    private function assertEndTime(int $expected, int $unix): void
    {
        $date = new DateTime($unix);
        $month = new Month($date);
        $result = $month->getEnd()->timestamp();
        $this->assertSame($expected, $result);
    }
    public function testGetEnd1(): void
    {
        $this->assertEndTime(testtime(2014, 7, 31), testtime(2014, 7, 15));
    }
    public function testGetEnd2(): void
    {
        $this->assertEndTime(testtime(2012, 2, 29), testtime(2012, 2, 28));
    }
    public function testGetEnd3(): void
    {
        $this->assertEndTime(testtime(2015, 6, 30), testtime(2015, 5, 32));
    }


    public function testNow(): void
    {
        $date = Date::now();
        $check = new Month($date);
        $month = Month::now();
        $this->assertSame($check->getStart()->timestamp(), $month->getStart()->timestamp());
        $this->assertSame($check->getEnd()->timestamp(), $month->getEnd()->timestamp());
    }


    private function assertRelativeTimes(int $start, int $end, Month $month): void
    {
        $this->assertSame($start, $month->getStart()->timestamp());
        $this->assertSame($end, $month->getEnd()->timestamp());
    }
    public function testAddMonths(): void
    {
        $month = new Month(Date::mkdate(2015, 6, 1));
        $month = $month->addMonths(2);

        $this->assertRelativeTimes(testtime(2015, 8, 1), testtime(2015, 8, 31), $month);
    }
    public function testSubMonths(): void
    {
        $month = new Month(Date::mkdate(2015, 1, 1));
        $month = $month->subMonths(1);

        $this->assertRelativeTimes(testtime(2014, 12, 1), testtime(2014, 12, 31), $month);
    }
    public function testAddYears(): void
    {
        $month = new Month(Date::mkdate(2015, 6, 1));
        $month = $month->addYears(2);

        $this->assertRelativeTimes(testtime(2017, 6, 1), testtime(2017, 6, 30), $month);
    }
    public function testSubYears(): void
    {
        $month = new Month(Date::mkdate(2015, 1, 1));
        $month = $month->subYears(1);

        $this->assertRelativeTimes(testtime(2014, 1, 1), testtime(2014, 1, 31), $month);
    }
}
