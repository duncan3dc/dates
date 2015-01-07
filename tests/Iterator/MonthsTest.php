<?php

namespace duncan3dc\DateTests\Iterator;

use duncan3dc\Dates\DateTime;
use duncan3dc\Dates\Range;

class MonthsTest extends \PHPUnit_Framework_TestCase
{

    public function assertRangeMonths($months, $start, $end)
    {
        $start = new DateTime($start);
        $end = new DateTime($end);
        $range = new Range($start, $end);
        $count = 0;
        foreach ($range->months() as $date) {
            $this->assertInstanceOf(DateTime::class, $date);
            ++$count;
        }
        $this->assertSame($months, $count);
    }


    public function test1Month()
    {
        $this->assertRangeMonths(2, mktime(12, 0, 0, 3, 20, 2014), mktime(12, 0, 0, 4, 20, 2014));
    }


    public function test12Months()
    {
        $this->assertRangeMonths(12, mktime(12, 0, 0, 2, 1, 2014), mktime(12, 0, 0, 1, 1, 2015));
    }


    public function testYearChange()
    {
        $this->assertRangeMonths(2, mktime(12, 0, 0, 12, 31, 2013), mktime(12, 0, 0, 1, 1, 2014));
    }


    public function testEarlyStartDate()
    {
        $this->assertRangeMonths(2, mktime(0, 0, 0, 6, 1, 2014), mktime(12, 0, 0, 7, 15, 2014));
    }


    public function testEarlyEndDate()
    {
        $this->assertRangeMonths(3, mktime(12, 0, 0, 5, 15, 2014), mktime(0, 0, 0, 7, 1, 2014));
    }


    public function testEarlyDates()
    {
        $this->assertRangeMonths(4, mktime(0, 0, 0, 4, 1, 2014), mktime(0, 0, 0, 7, 1, 2014));
    }


    public function testLateStartDate()
    {
        $this->assertRangeMonths(1, mktime(23, 59, 59, 6, 30, 2014), mktime(12, 0, 0, 6, 15, 2014));
    }


    public function testLateEndDate()
    {
        $this->assertRangeMonths(8, mktime(12, 0, 0, 8, 15, 2014), mktime(23, 59, 59, 3, 31, 2015));
    }


    public function testLateDates()
    {
        $this->assertRangeMonths(4, mktime(23, 59, 59, 1, 31, 2014), mktime(23, 59, 59, 4, 30, 2014));
    }


    public function testEarlyAndLateDates()
    {
        $this->assertRangeMonths(2, mktime(0, 0, 0, 4, 1, 2014), mktime(23, 59, 59, 5, 31, 2014));
    }
}
