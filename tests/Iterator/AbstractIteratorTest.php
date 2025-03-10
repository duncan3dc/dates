<?php

namespace duncan3dc\DateTests\Iterator;

use duncan3dc\Dates\Date;
use duncan3dc\Dates\Range;
use PHPUnit\Framework\TestCase;

final class AbstractIteratorTest extends TestCase
{
    public function testCurrent(): void
    {
        $date = Date::now();
        $range = new Range($date, $date);
        $count = 0;
        $iterator = $range->days();
        foreach ($iterator as $key => $date) {
            ++$count;
        }
        $this->assertSame(1, $count);
    }

    public function testCount(): void
    {
        $date = Date::now();
        $range = new Range($date, $date->addDays(4));
        $iterator = $range->days();
        $count = 0;
        foreach ($iterator as $key => $date) {
            ++$count;
        }
        $this->assertSame(5, count($iterator));
        $this->assertSame(5, $count);
    }
}
