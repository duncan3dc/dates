<?php

namespace duncan3dc\DateTests\Iterator;

use duncan3dc\Dates\DateTime;
use duncan3dc\Dates\Range;
use PHPUnit\Framework\TestCase;

use function duncan3dc\DateTests\testtime;

final class MinutesTest extends TestCase
{
    public function assertRangeMinutes(int $minutes, int $start, int $end): void
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


    public function testSeconds(): void
    {
        $this->assertRangeMinutes(1, testtime(2014, 3, 20), testtime(2014, 3, 20, 12, 0, 59));
    }


    public function test1Minute(): void
    {
        $this->assertRangeMinutes(2, testtime(2014, 3, 20), testtime(2014, 3, 20, 12, 1, 0));
    }


    public function test60Minutes(): void
    {
        $this->assertRangeMinutes(61, testtime(2014, 1, 1), testtime(2014, 1, 1, 13, 0, 0));
    }


    public function testLateStartTime(): void
    {
        $this->assertRangeMinutes(2, testtime(2014, 2, 10, 23, 59, 59), testtime(2014, 2, 11, 0));
    }


    public function testLateEndTime(): void
    {
        $this->assertRangeMinutes(2, testtime(2014, 2, 20), testtime(2014, 2, 20, 12, 1, 59));
    }


    public function testLateTimes1(): void
    {
        $this->assertRangeMinutes(1, testtime(2014, 4, 14, 23, 59, 59), testtime(2014, 4, 14, 23, 59, 59));
    }
    public function testLateTimes2(): void
    {
        $this->assertRangeMinutes(2, testtime(2014, 4, 14, 23, 58, 59), testtime(2014, 4, 14, 23, 59, 59));
    }


    public function testEarlyAndLateTimes(): void
    {
        $this->assertRangeMinutes(1440, testtime(2014, 4, 14, 0), testtime(2014, 4, 14, 23, 59, 59));
    }
}
