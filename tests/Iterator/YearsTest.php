<?php

namespace duncan3dc\DateTests\Iterator;

use duncan3dc\Dates\DateTime;
use duncan3dc\Dates\Range;
use duncan3dc\Dates\Year;
use PHPUnit\Framework\TestCase;

use function duncan3dc\DateTests\testtime;

final class YearsTest extends TestCase
{
    public function assertRangeYears(int $years, int $start, int $end): void
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


    public function test1Year(): void
    {
        $this->assertRangeYears(2, testtime(2014, 6, 15), testtime(2015, 6, 15));
    }


    public function testLateStartDate(): void
    {
        $this->assertRangeYears(1, testtime(2014, 6, 15), testtime(2014, 12, 31, 23, 59, 59));
    }


    public function testLateEndDate(): void
    {
        $this->assertRangeYears(2, testtime(2014, 6, 15), testtime(2015, 12, 31, 23, 59, 59));
    }


    public function testLateDates(): void
    {
        $this->assertRangeYears(3, testtime(2014, 12, 31, 23, 59, 59), testtime(2016, 12, 31, 23, 59, 59));
    }
}
