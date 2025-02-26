<?php

namespace duncan3dc\DateTests\Iterator;

use duncan3dc\Dates\DateTime;
use duncan3dc\Dates\Range;
use PHPUnit\Framework\TestCase;

final class SecondsTest extends TestCase
{
    public function assertRangeSeconds(int $seconds, int $start, int $end): void
    {
        $start = new DateTime($start);
        $end = new DateTime($end);
        $range = new Range($start, $end);
        $count = 0;
        foreach ($range->seconds() as $date) {
            $this->assertInstanceOf(DateTime::class, $date);
            ++$count;
        }
        $this->assertSame($seconds, $count);
    }


    public function testSameTime(): void
    {
        $this->assertRangeSeconds(1, mktime(12, 0, 0, 3, 20, 2014), mktime(12, 0, 0, 3, 20, 2014));
    }


    public function test1Second(): void
    {
        $this->assertRangeSeconds(2, mktime(12, 0, 0, 3, 20, 2014), mktime(12, 0, 1, 3, 20, 2014));
    }


    public function test1Minute(): void
    {
        $this->assertRangeSeconds(61, mktime(12, 0, 0, 1, 1, 2014), mktime(12, 1, 0, 1, 1, 2014));
    }
}
