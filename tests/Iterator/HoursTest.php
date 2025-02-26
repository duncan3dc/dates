<?php

namespace duncan3dc\DateTests\Iterator;

use duncan3dc\Dates\DateTime;
use duncan3dc\Dates\Range;
use PHPUnit\Framework\TestCase;

use function duncan3dc\DateTests\testtime;

final class HoursTest extends TestCase
{
    public function assertRangeHours(int $hours, int $start, int $end): void
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
        $this->assertRangeHours(2, testtime(2014, 3, 20), testtime(2014, 3, 20, 13, 0, 0));
    }


    public function test24Hours(): void
    {
        $this->assertRangeHours(25, testtime(2014, 1, 1), testtime(2014, 1, 2));
    }


    public function testLateStartTime(): void
    {
        $this->assertRangeHours(2, testtime(2014, 2, 10, 23, 59, 59), testtime(2014, 2, 11, 0));
    }


    public function testLateEndTime(): void
    {
        $this->assertRangeHours(12, testtime(2014, 2, 20), testtime(2014, 2, 20, 23, 59, 59));
    }


    public function testLateTimes1(): void
    {
        $this->assertRangeHours(1, testtime(2014, 4, 14, 23, 59, 59), testtime(2014, 4, 14, 23, 59, 59));
    }
    public function testLateTimes2(): void
    {
        $this->assertRangeHours(25, testtime(2014, 4, 14, 23, 59, 59), testtime(2014, 4, 15, 23, 59, 59));
    }


    public function testEarlyAndLateTimes(): void
    {
        $this->assertRangeHours(24, testtime(2014, 4, 14, 0), testtime(2014, 4, 14, 23, 59, 59));
    }
}
