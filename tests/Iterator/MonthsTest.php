<?php

namespace duncan3dc\DateTests\Iterator;

use duncan3dc\Dates\DateTime;
use duncan3dc\Dates\Month;
use duncan3dc\Dates\Range;
use PHPUnit\Framework\TestCase;

class MonthsTest extends TestCase
{
    public function assertRangeMonths($months, $start, $end)
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
        $this->assertRangeMonths(2, mktime(12, 0, 0, 3, 20, 2014), mktime(12, 0, 0, 4, 20, 2014));
    }


    public function test12Months(): void
    {
        $this->assertRangeMonths(12, mktime(12, 0, 0, 2, 1, 2014), mktime(12, 0, 0, 1, 1, 2015));
    }


    public function testYearChange(): void
    {
        $this->assertRangeMonths(2, mktime(12, 0, 0, 12, 31, 2013), mktime(12, 0, 0, 1, 1, 2014));
    }


    public function testEarlyStartDate(): void
    {
        $this->assertRangeMonths(2, mktime(0, 0, 0, 6, 1, 2014), mktime(12, 0, 0, 7, 15, 2014));
    }


    public function testEarlyEndDate(): void
    {
        $this->assertRangeMonths(3, mktime(12, 0, 0, 5, 15, 2014), mktime(0, 0, 0, 7, 1, 2014));
    }


    public function testEarlyDates(): void
    {
        $this->assertRangeMonths(4, mktime(0, 0, 0, 4, 1, 2014), mktime(0, 0, 0, 7, 1, 2014));
    }


    public function testLateStartDate(): void
    {
        $this->assertRangeMonths(1, mktime(23, 59, 59, 6, 15, 2014), mktime(12, 0, 0, 6, 30, 2014));
    }


    public function testLateEndDate(): void
    {
        $this->assertRangeMonths(8, mktime(12, 0, 0, 8, 15, 2014), mktime(23, 59, 59, 3, 31, 2015));
    }


    public function testLateDates(): void
    {
        $this->assertRangeMonths(4, mktime(23, 59, 59, 1, 31, 2014), mktime(23, 59, 59, 4, 30, 2014));
    }


    public function testEarlyAndLateDates(): void
    {
        $this->assertRangeMonths(2, mktime(0, 0, 0, 4, 1, 2014), mktime(23, 59, 59, 5, 31, 2014));
    }
}
