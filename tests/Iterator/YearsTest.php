<?php

namespace duncan3dc\DateTests\Iterator;

use duncan3dc\Dates\DateTime;
use duncan3dc\Dates\Range;
use duncan3dc\Dates\Year;

class YearsTest extends \PHPUnit_Framework_TestCase
{

    public function assertRangeYears($years, $start, $end)
    {
        $start = new DateTime($start);
        $end = new DateTime($end);
        $range = new Range($start, $end);
        $count = 0;
        foreach ($range->years() as $date) {
            $this->assertInstanceOf(Year::class, $date);
            ++$count;
        }
        $this->assertSame($years, $count);
    }


    public function test1Year()
    {
        $this->assertRangeYears(2, mktime(12, 0, 0, 6, 15, 2014), mktime(12, 0, 0, 6, 15, 2015));
    }


    public function testLateStartDate()
    {
        $this->assertRangeYears(1, mktime(12, 0, 0, 6, 15, 2014), mktime(23, 59, 59, 12, 31, 2014));
    }


    public function testLateEndDate()
    {
        $this->assertRangeYears(2, mktime(12, 0, 0, 6, 15, 2014), mktime(23, 59, 59, 12, 31, 2015));
    }


    public function testLateDates()
    {
        $this->assertRangeYears(3, mktime(23, 59, 59, 12, 31, 2014), mktime(23, 59, 59, 12, 31, 2016));
    }
}
