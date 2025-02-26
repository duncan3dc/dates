<?php

namespace duncan3dc\DateTests\Iterator;

use duncan3dc\Dates\DateTime;
use duncan3dc\Dates\Month;
use duncan3dc\Dates\Range;
use PHPUnit\Framework\TestCase;

use function duncan3dc\DateTests\testtime;

final class MonthsTest extends TestCase
{
    public function assertRangeMonths(int $months, int $start, int $end): void
    {
        $start = new DateTime($start);
        $end = new DateTime($end);
        $range = new Range($start, $end);
        $count = 0;
        foreach ($range->months() as $date) {
            $this->assertInstanceOf(Month::class, $date);
            ++$count;
        }
        $this->assertSame($months, $count);
    }


    public function test1Month(): void
    {
        $this->assertRangeMonths(2, testtime(2014, 3, 20), testtime(2014, 4, 20));
    }


    public function test12Months(): void
    {
        $this->assertRangeMonths(12, testtime(2014, 2, 1), testtime(2015, 1, 1));
    }


    public function testYearChange(): void
    {
        $this->assertRangeMonths(2, testtime(2013, 12, 31), testtime(2014, 1, 1));
    }


    public function testEarlyStartDate(): void
    {
        $this->assertRangeMonths(2, testtime(2014, 6, 1, 0), testtime(2014, 7, 15));
    }


    public function testEarlyEndDate(): void
    {
        $this->assertRangeMonths(3, testtime(2014, 5, 15), testtime(2014, 7, 1, 0));
    }


    public function testEarlyDates(): void
    {
        $this->assertRangeMonths(4, testtime(2014, 4, 1, 0), testtime(2014, 7, 1, 0));
    }


    public function testLateStartDate(): void
    {
        $this->assertRangeMonths(1, testtime(2014, 6, 15, 23, 59, 59), testtime(2014, 6, 30));
    }


    public function testLateEndDate(): void
    {
        $this->assertRangeMonths(8, testtime(2014, 8, 15), testtime(2015, 3, 31, 23, 59, 59));
    }


    public function testLateDates(): void
    {
        $this->assertRangeMonths(4, testtime(2014, 1, 31, 23, 59, 59), testtime(2014, 4, 30, 23, 59, 59));
    }


    public function testEarlyAndLateDates(): void
    {
        $this->assertRangeMonths(2, testtime(2014, 4, 1, 0), testtime(2014, 5, 31, 23, 59, 59));
    }
}
