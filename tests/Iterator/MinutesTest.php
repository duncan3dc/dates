<?php

namespace duncan3dc\Dates\Iterator;

use duncan3dc\Dates\DateTime;
use duncan3dc\Dates\Range;

class MinutesTest extends \PHPUnit_Framework_TestCase
{

    public function assertRangeMinutes($minutes, $start, $end)
    {
        $start = new DateTime($start);
        $end = new DateTime($end);
        $range = new Range($start, $end);
        $count = 0;
        foreach ($range->minutes() as $date) {
            $this->assertInstanceOf(DateTime::class, $date);
            ++$count;
        }
        $this->assertSame($minutes, $count);
    }


    public function testSeconds()
    {
        $this->assertRangeMinutes(1, mktime(12, 0, 0, 3, 20, 2014), mktime(12, 0, 59, 3, 20, 2014));
    }


    public function test1Minute()
    {
        $this->assertRangeMinutes(2, mktime(12, 0, 0, 3, 20, 2014), mktime(12, 1, 0, 3, 20, 2014));
    }


    public function test60Minutes()
    {
        $this->assertRangeMinutes(61, mktime(12, 0, 0, 1, 1, 2014), mktime(13, 0, 0, 1, 1, 2014));
    }


    public function testLateStartTime()
    {
        $this->assertRangeMinutes(2, mktime(23, 59, 59, 2, 10, 2014), mktime(0, 0, 0, 2, 11, 2014));
    }


    public function testLateEndTime()
    {
        $this->assertRangeMinutes(2, mktime(12, 0, 0, 2, 20, 2014), mktime(12, 1, 59, 2, 20, 2014));
    }


    public function testLateTimes1()
    {
        $this->assertRangeMinutes(1, mktime(23, 59, 59, 4, 14, 2014), mktime(23, 59, 59, 4, 14, 2014));
    }
    public function testLateTimes2()
    {
        $this->assertRangeMinutes(2, mktime(23, 58, 59, 4, 14, 2014), mktime(23, 59, 59, 4, 14, 2014));
    }


    public function testEarlyAndLateTimes()
    {
        $this->assertRangeMinutes(1440, mktime(0, 0, 0, 4, 14, 2014), mktime(23, 59, 59, 4, 14, 2014));
    }
}