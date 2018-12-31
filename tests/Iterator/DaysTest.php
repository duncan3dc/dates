<?php

namespace duncan3dc\DateTests\Iterator;

use duncan3dc\Dates\DateTime;
use duncan3dc\Dates\Range;
use PHPUnit\Framework\TestCase;

class DaysTest extends TestCase
{

    public function assertRangeDays($days, $start, $end)
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


    public function test1Day()
    {
        $this->assertRangeDays(2, mktime(12, 0, 0, 3, 20, 2014), mktime(12, 0, 0, 3, 21, 2014));
    }


    public function test31Days()
    {
        $this->assertRangeDays(32, mktime(12, 0, 0, 1, 1, 2014), mktime(12, 0, 0, 2, 1, 2014));
    }


    public function testMonthChange()
    {
        $this->assertRangeDays(11, mktime(12, 0, 0, 11, 21, 2014), mktime(12, 0, 0, 12, 1, 2014));
    }


    public function testYearChange()
    {
        $this->assertRangeDays(2, mktime(12, 0, 0, 12, 31, 2013), mktime(12, 0, 0, 1, 1, 2014));
    }


    public function testEarlyStartTime()
    {
        $this->assertRangeDays(3, mktime(0, 0, 0, 6, 20, 2014), mktime(12, 0, 0, 6, 22, 2014));
    }


    public function testEarlyEndTime()
    {
        $this->assertRangeDays(3, mktime(12, 0, 0, 5, 5, 2014), mktime(0, 0, 0, 5, 7, 2014));
    }


    public function testEarlyTimes()
    {
        $this->assertRangeDays(4, mktime(0, 0, 0, 4, 14, 2014), mktime(0, 0, 0, 4, 17, 2014));
    }


    public function testLateStartTime()
    {
        $this->assertRangeDays(11, mktime(23, 59, 59, 2, 10, 2014), mktime(12, 0, 0, 2, 20, 2014));
    }


    public function testLateEndTime()
    {
        $this->assertRangeDays(8, mktime(12, 0, 0, 2, 20, 2014), mktime(23, 59, 59, 2, 27, 2014));
    }


    public function testLateTimes()
    {
        $this->assertRangeDays(4, mktime(23, 59, 59, 4, 14, 2014), mktime(23, 59, 59, 4, 17, 2014));
    }


    public function testEarlyAndLateTimes()
    {
        $this->assertRangeDays(4, mktime(0, 0, 0, 4, 14, 2014), mktime(23, 59, 59, 4, 17, 2014));
    }
}
