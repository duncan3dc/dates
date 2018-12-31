<?php

namespace duncan3dc\DateTests;

use duncan3dc\Dates\Date;
use duncan3dc\Dates\DateTime;
use duncan3dc\Dates\Interfaces\DateTimeInterface;
use duncan3dc\Dates\Range;
use PHPUnit\Framework\TestCase;

final class RangeTest extends TestCase
{
    public function testGetStart(): void
    {
        $date = Date::now();
        $range = new Range($date, $date);
        $this->assertSame($date, $range->getStart());
    }


    public function testGetEnd(): void
    {
        $date = Date::now();
        $range = new Range($date, $date);
        $this->assertSame($date, $range->getEnd());
    }


    public function testInvalidRange(): void
    {
        $date = Date::now();
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage("Invalid range, the start date must be before the end date");
        new Range($date, $date->subDays(1));
    }


    /**
     * @return iterable<array<DateTimeInterface|string>>
     */
    public function rangeProvider(): iterable
    {
        $data = [
            ["2017-01-01 13:00:00", "0 seconds"],
            ["2017-01-01 13:00:01", "1 second"],
            ["2017-01-01 13:00:05", "5 seconds"],
            ["2017-01-01 13:00:59", "59 seconds"],
            ["2017-01-01 13:01:00", "1 minute"],
            ["2017-01-01 13:01:01", "1 minute"],
            ["2017-01-01 13:01:59", "2 minutes"],
            ["2017-01-01 13:59:59", "60 minutes"],
            ["2017-01-01 14:00:00", "1 hour"],
            ["2017-01-01 14:30:00", "2 hours"],
            ["2017-01-02 12:59:59", "24 hours"],
            ["2017-01-02 13:00:00", "1 day"],
            ["2017-01-03 01:00:00", "2 days"],
            ["2017-01-03 01:00:00", "2 days"],
            ["2017-01-08 12:00:00", "7 days"],
            ["2017-01-08 13:00:00", "1 week"],
            ["2017-01-15 12:00:00", "2 weeks"],
            ["2017-01-29 12:00:00", "4 weeks"],
            ["2017-01-29 13:00:00", "1 month"],
            ["2017-02-14 13:00:00", "2 months"],
            ["2017-12-01 12:00:00", "12 months"],
            ["2018-01-01 13:00:00", "1 year"],
            ["2018-12-01 13:00:00", "2 years"],
        ];
        foreach ($data as $row) {
            yield [
                DateTime::mktime(13, 0, 0, 1, 1, 2017),
                DateTime::fromFormat("Y-m-d H:i:s", $row[0]),
                $row[1],
            ];
        }
    }
    /**
     * @dataProvider rangeProvider
     */
    public function testAsString(DateTime $from, DateTime $to, string $expected): void
    {
        $range = new Range($from, $to);
        $this->assertSame($expected, $range->asString());
    }
}
