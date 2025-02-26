<?php

namespace duncan3dc\DateTests\Iterator;

use duncan3dc\Dates\DateTime;
use duncan3dc\Dates\Range;
use PHPUnit\Framework\TestCase;

use function duncan3dc\DateTests\testtime;

final class DaysTest extends TestCase
{
    public function assertRangeDays(int $days, int $start, int $end): void
    {
        $start = new DateTime($start);
        $end = new DateTime($end);
        $range = new Range($start, $end);
        $count = 0;
        foreach ($range->days() as $date) {
            $this->assertInstanceOf("duncan3dc\\Dates\\DateTime", $date);
            ++$count;
        }
        $this->assertSame($days, $count);
    }


    public function test1Day(): void
    {
        $this->assertRangeDays(2, testtime(2014, 3, 20), testtime(2014, 3, 21));
    }


    public function test31Days(): void
    {
        $this->assertRangeDays(32, testtime(2014, 1, 1), testtime(2014, 2, 1));
    }


    public function testMonthChange(): void
    {
        $this->assertRangeDays(11, testtime(2014, 11, 21), testtime(2014, 12, 1));
    }


    public function testYearChange(): void
    {
        $this->assertRangeDays(2, testtime(2013, 12, 31), testtime(2014, 1, 1));
    }


    public function testEarlyStartTime(): void
    {
        $this->assertRangeDays(3, testtime(2014, 6, 20, 0), testtime(2014, 6, 22));
    }


    public function testEarlyEndTime(): void
    {
        $this->assertRangeDays(3, testtime(2014, 5, 5), testtime(2014, 5, 7, 0));
    }


    public function testEarlyTimes(): void
    {
        $this->assertRangeDays(4, testtime(2014, 4, 14, 0), testtime(2014, 4, 17, 0));
    }


    public function testLateStartTime(): void
    {
        $this->assertRangeDays(11, testtime(2014, 2, 10, 23, 59, 59), testtime(2014, 2, 20));
    }


    public function testLateEndTime(): void
    {
        $this->assertRangeDays(8, testtime(2014, 2, 20), testtime(2014, 2, 27, 23, 59, 59));
    }


    public function testLateTimes(): void
    {
        $this->assertRangeDays(4, testtime(2014, 4, 14, 23, 59, 59), testtime(2014, 4, 17, 23, 59, 59));
    }


    public function testEarlyAndLateTimes(): void
    {
        $this->assertRangeDays(4, testtime(2014, 4, 14, 0), testtime(2014, 4, 17, 23, 59, 59));
    }
}
