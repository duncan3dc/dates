<?php

namespace duncan3dc\DateTests;

use duncan3dc\Dates\Date;
use duncan3dc\Dates\DateTime;
use PHPUnit\Framework\TestCase;

use function mktime;

final class DateTest extends TestCase
{
    public function testConstructor(): void
    {
        $unix = time();
        $datetime = new DateTime($unix);
        $date = new Date($unix);
        $this->assertSame($datetime->midday(), $date->timestamp());
    }


    public function testNow(): void
    {
        $date = Date::now();
        $result = mktime(12, 0, 0, (int) date("n"), (int) date("j"), (int) date("Y"));
        $this->assertSame($result, $date->timestamp());
    }


    public function testParse(): void
    {
        $input = "2008-02-22";
        $result = Date::parse($input)->format("Y-m-d");
        $this->assertSame($input, $result);
    }


    public function testMkdate(): void
    {
        $date = Date::mkdate(2014, 6, 12);
        $this->assertSame(testtime(2014, 6, 12), $date->timestamp());
    }


    public function testWithHours(): void
    {
        $date = Date::mkdate(2016, 2, 20);
        $date = $date->withHours(10);
        $this->assertInstanceOf(DateTime::class, $date);
        $this->assertSame("2016-02-20 10:00:00", $date->format("Y-m-d H:i:s"));
    }


    public function testWithMinutes(): void
    {
        $date = Date::mkdate(2016, 2, 20);
        $date = $date->withMinutes(10);
        $this->assertInstanceOf(DateTime::class, $date);
        $this->assertSame("2016-02-20 12:10:00", $date->format("Y-m-d H:i:s"));
    }


    public function testWithSeconds(): void
    {
        $date = Date::mkdate(2016, 2, 20);
        $date = $date->withSeconds(10);
        $this->assertInstanceOf(DateTime::class, $date);
        $this->assertSame("2016-02-20 12:00:10", $date->format("Y-m-d H:i:s"));
    }
}
