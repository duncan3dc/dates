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
        $this->assertStartTime(testtime(2015, 1, 1), testtime(2015, 2, 1));
    }
    public function testGetStart2(): void
    {
        $this->assertStartTime(testtime(2015, 1, 1), testtime(2015, 7, 31));
    }
    public function testGetStart3(): void
    {
        $this->assertStartTime(testtime(2015, 1, 1), testtime(2015, 8, 1));
    }
    public function testGetStart4(): void
    {
        $this->assertStartTime(testtime(2015, 1, 1), testtime(2015, 1, 31));
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
        $this->assertEndTime(testtime(2014, 12, 31), testtime(2014, 2, 1));
    }
    public function testGetEnd2(): void
    {
        $this->assertEndTime(testtime(2014, 12, 31), testtime(2014, 7, 31));
    }
    public function testGetEnd3(): void
    {
        $this->assertEndTime(testtime(2014, 12, 31), testtime(2014, 8, 1));
    }
    public function testGetEnd4(): void
    {
        $this->assertEndTime(testtime(2015, 12, 31), testtime(2015, 1, 31));
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

        $this->assertRelativeTimes(testtime(2017, 1, 1), testtime(2017, 12, 31), $year);
    }
    public function testSubYears(): void
    {
        $year = new Year(Date::mkdate(2015, 1, 1));
        $year = $year->subYears(1);

        $this->assertRelativeTimes(testtime(2014, 1, 1), testtime(2014, 12, 31), $year);
    }


    public function testFromInt(): void
    {
        $year = Year::fromInt(2013);

        $this->assertSame(2013, $year->numeric("Y"));
    }
}
