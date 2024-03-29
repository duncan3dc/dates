<?php

namespace duncan3dc\Dates\Iterator;

use duncan3dc\Dates\DateTime;
use duncan3dc\Dates\Range;
use PHPUnit\Framework\TestCase;

class HoursTest extends TestCase
{
    public function assertRangeHours($hours, $start, $end)
    {
        $start = new DateTime($start);
        $end = new DateTime($end);
        $range = new Range($start, $end);
        $count = 0;
        foreach ($range->hours() as $date) {
            $this->assertInstanceOf(DateTime::class, $date);
            ++$count;
        }
        $this->assertSame($hours, $count);
    }


    public function test1Hour(): void
    {
        $this->assertRangeHours(2, mktime(12, 0, 0, 3, 20, 2014), mktime(13, 0, 0, 3, 20, 2014));
    }


    public function test24Hours(): void
    {
        $this->assertRangeHours(25, mktime(12, 0, 0, 1, 1, 2014), mktime(12, 0, 0, 1, 2, 2014));
    }


    public function testLateStartTime(): void
    {
        $this->assertRangeHours(2, mktime(23, 59, 59, 2, 10, 2014), mktime(0, 0, 0, 2, 11, 2014));
    }


    public function testLateEndTime(): void
    {
        $this->assertRangeHours(12, mktime(12, 0, 0, 2, 20, 2014), mktime(23, 59, 59, 2, 20, 2014));
    }


    public function testLateTimes1(): void
    {
        $this->assertRangeHours(1, mktime(23, 59, 59, 4, 14, 2014), mktime(23, 59, 59, 4, 14, 2014));
    }
    public function testLateTimes2(): void
    {
        $this->assertRangeHours(25, mktime(23, 59, 59, 4, 14, 2014), mktime(23, 59, 59, 4, 15, 2014));
    }


    public function testEarlyAndLateTimes(): void
    {
        $this->assertRangeHours(24, mktime(0, 0, 0, 4, 14, 2014), mktime(23, 59, 59, 4, 14, 2014));
    }
}
