<?php

namespace duncan3dc\DateTests;

use duncan3dc\Dates\Date;
use duncan3dc\Dates\Interfaces\Days;
use PHPUnit\Framework\TestCase;

class DayHelpersTest extends TestCase
{
    public function testIsMonday(): void
    {
        $date = new Date(mktime(12, 0, 0, 1, 12, 2015));
        $this->assertTrue($date->isMonday());
    }


    public function testIsTuesday(): void
    {
        $date = new Date(mktime(12, 0, 0, 1, 13, 2015));
        $this->assertTrue($date->isTuesday());
    }


    public function testIsWednesday(): void
    {
        $date = new Date(mktime(12, 0, 0, 1, 14, 2015));
        $this->assertTrue($date->isWednesday());
    }


    public function testIsThursday(): void
    {
        $date = new Date(mktime(12, 0, 0, 1, 15, 2015));
        $this->assertTrue($date->isThursday());
    }


    public function testIsFriday(): void
    {
        $date = new Date(mktime(12, 0, 0, 1, 16, 2015));
        $this->assertTrue($date->isFriday());
    }


    public function testIsSaturday(): void
    {
        $date = new Date(mktime(12, 0, 0, 1, 17, 2015));
        $this->assertTrue($date->isSaturday());
    }


    public function testIsSunday(): void
    {
        $date = new Date(mktime(12, 0, 0, 1, 18, 2015));
        $this->assertTrue($date->isSunday());
    }


    public function testIsWeekend(): void
    {
        $date = new Date(mktime(12, 0, 0, 1, 18, 2015));
        $this->assertTrue($date->isWeekend());
    }


    public function testIsWeekday(): void
    {
        $date = new Date(mktime(12, 0, 0, 1, 14, 2015));
        $this->assertTrue($date->isWeekday());
    }


    public function nextDayProvider(): iterable
    {
        $data = [
            ["2016-06-08", Days::SUNDAY, "2016-06-12"],
            ["2016-06-08", Days::MONDAY, "2016-06-13"],
            ["2016-06-08", Days::TUESDAY, "2016-06-14"],
            ["2016-06-08", Days::WEDNESDAY, "2016-06-15"],
            ["2016-06-08", Days::THURSDAY, "2016-06-09"],
            ["2016-06-08", Days::FRIDAY, "2016-06-10"],
            ["2016-06-08", Days::SATURDAY, "2016-06-11"],
            ["2016-06-10", Days::SATURDAY, "2016-06-11"],
            ["2016-06-11", Days::SATURDAY, "2016-06-18"],
            ["2016-06-11", Days::SUNDAY, "2016-06-12"],
            ["2016-06-12", Days::SUNDAY, "2016-06-19"],
        ];
        foreach ($data as $row) {
            $date = Date::fromFormat("Y-m-d", $row[0]);
            yield [$date, $row[1], $row[2]];
        }
    }
    /**
     * @dataProvider nextDayProvider
     */
    public function testGetNext(Date $date, $day, $expected): void
    {
        $original = $date->format("Y-m-d");

        $result = $date->getNext($day);

        $this->assertSame($expected, $result->format("Y-m-d"));

        $this->assertSame($original, $date->format("Y-m-d"));
    }


    public function previousDayProvider(): iterable
    {
        $data = [
            ["2016-06-08", Days::SUNDAY, "2016-06-05"],
            ["2016-06-08", Days::MONDAY, "2016-06-06"],
            ["2016-06-08", Days::TUESDAY, "2016-06-07"],
            ["2016-06-08", Days::WEDNESDAY, "2016-06-01"],
            ["2016-06-08", Days::THURSDAY, "2016-06-02"],
            ["2016-06-08", Days::FRIDAY, "2016-06-03"],
            ["2016-06-08", Days::SATURDAY, "2016-06-04"],
            ["2016-06-12", Days::SATURDAY, "2016-06-11"],
            ["2016-06-11", Days::SATURDAY, "2016-06-04"],
            ["2016-06-13", Days::SUNDAY, "2016-06-12"],
            ["2016-06-12", Days::SUNDAY, "2016-06-05"],
        ];
        foreach ($data as $row) {
            $date = Date::fromFormat("Y-m-d", $row[0]);
            yield [$date, $row[1], $row[2]];
        }
    }
    /**
     * @dataProvider previousDayProvider
     */
    public function testGetPrevious(Date $date, $day, $expected): void
    {
        $original = $date->format("Y-m-d");

        $result = $date->getPrevious($day);

        $this->assertSame($expected, $result->format("Y-m-d"));

        $this->assertSame($original, $date->format("Y-m-d"));
    }
}
