<?php

namespace duncan3dc\DateTests;

use duncan3dc\Dates\Date;
use duncan3dc\Dates\DateTime;
use duncan3dc\Dates\Interfaces\YearInterface;
use duncan3dc\Dates\Year;
use PHPUnit\Framework\TestCase;

final class YearTest extends TestCase
{
    private function assertStartTime(int $expected, int $unix): void
    {
        $date = new DateTime($unix);
        $year = new Year($date);
        $result = $year->getStart()->timestamp();
        $this->assertSame($expected, $result);
    }
    public function testGetStart1(): void
    {
        $this->assertStartTime(mktime(12, 0, 0, 1, 1, 2015), mktime(12, 0, 0, 2, 1, 2015));
    }
    public function testGetStart2(): void
    {
        $this->assertStartTime(mktime(12, 0, 0, 1, 1, 2015), mktime(12, 0, 0, 7, 31, 2015));
    }
    public function testGetStart3(): void
    {
        $this->assertStartTime(mktime(12, 0, 0, 1, 1, 2015), mktime(12, 0, 0, 8, 1, 2015));
    }
    public function testGetStart4(): void
    {
        $this->assertStartTime(mktime(12, 0, 0, 1, 1, 2015), mktime(12, 0, 0, 1, 31, 2015));
    }


    private function assertEndTime(int $expected, int $unix): void
    {
        $date = new DateTime($unix);
        $year = new Year($date);
        $result = $year->getEnd()->timestamp();
        $this->assertSame($expected, $result);
    }
    public function testGetEnd1(): void
    {
        $this->assertEndTime(mktime(12, 0, 0, 12, 31, 2014), mktime(12, 0, 0, 2, 1, 2014));
    }
    public function testGetEnd2(): void
    {
        $this->assertEndTime(mktime(12, 0, 0, 12, 31, 2014), mktime(12, 0, 0, 7, 31, 2014));
    }
    public function testGetEnd3(): void
    {
        $this->assertEndTime(mktime(12, 0, 0, 12, 31, 2014), mktime(12, 0, 0, 8, 1, 2014));
    }
    public function testGetEnd4(): void
    {
        $this->assertEndTime(mktime(12, 0, 0, 12, 31, 2015), mktime(12, 0, 0, 1, 31, 2015));
    }


    public function testNow(): void
    {
        $date = Date::now();
        $check = new Year($date);
        $year = Year::now();
        $this->assertSame($check->getStart()->timestamp(), $year->getStart()->timestamp());
        $this->assertSame($check->getEnd()->timestamp(), $year->getEnd()->timestamp());
    }


    private function assertRelativeTimes(int $start, int $end, YearInterface $year): void
    {
        $this->assertSame($start, $year->getStart()->timestamp());
        $this->assertSame($end, $year->getEnd()->timestamp());
    }
    public function testAddYears(): void
    {
        $year = new Year(Date::mkdate(2015, 6, 1));
        $year = $year->addYears(2);

        $this->assertRelativeTimes(mktime(12, 0, 0, 1, 1, 2017), mktime(12, 0, 0, 12, 31, 2017), $year);
    }
    public function testSubYears(): void
    {
        $year = new Year(Date::mkdate(2015, 1, 1));
        $year = $year->subYears(1);

        $this->assertRelativeTimes(mktime(12, 0, 0, 1, 1, 2014), mktime(12, 0, 0, 12, 31, 2014), $year);
    }


    public function testFromInt(): void
    {
        $year = Year::fromInt(2013);

        $this->assertSame(2013, $year->numeric("Y"));
    }
}
