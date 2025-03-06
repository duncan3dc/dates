<?php

namespace duncan3dc\DateTests;

use duncan3dc\Dates\DateTime;
use PHPUnit\Framework\TestCase;

final class RelativeDateTimesTest extends TestCase
{
    public function testAddWeeks1(): void
    {
        $date = new DateTime(testtime(2013, 2, 28));
        $result = $date->addWeeks(2);
        $this->assertSame(testtime(2013, 3, 14), $result->timestamp());
    }
    public function testAddWeeks2(): void
    {
        $date = new DateTime(testtime(2013, 2, 28));
        $result = $date->addWeeks(-2);
        $this->assertSame(testtime(2013, 2, 14), $result->timestamp());
    }
    public function testAddWeeks3(): void
    {
        $date = new DateTime(testtime(2013, 2, 28));
        $result = $date->addWeeks(0);
        $this->assertSame($date, $result);
    }
    public function testSubWeeks1(): void
    {
        $date = new DateTime(testtime(2014, 10, 2));
        $result = $date->subWeeks(2);
        $this->assertSame(testtime(2014, 9, 18), $result->timestamp());
    }
    public function testSubWeeks2(): void
    {
        $date = new DateTime(testtime(2013, 10, 2));
        $result = $date->subWeeks(-2);
        $this->assertSame(testtime(2013, 10, 16), $result->timestamp());
    }


    public function testAddMonths1(): void
    {
        $date = new DateTime(testtime(2014, 3, 31));
        $result = $date->addMonths(2);
        $this->assertSame(testtime(2014, 5, 31), $result->timestamp());
    }
    public function testAddMonths2(): void
    {
        $date = new DateTime(testtime(2012, 1, 31));
        $result = $date->addMonths(-2);
        $this->assertSame(testtime(2011, 11, 30), $result->timestamp());
    }


    public function testNextMonth(): void
    {
        $date = new DateTime(testtime(1970, 3, 31, 23, 59, 59));
        $result = $date->addMonths(1);
        $this->assertSame(testtime(1970, 4, 30, 23, 59, 59), $result->timestamp());
    }
    public function testPrevMonth(): void
    {
        $date = new DateTime(testtime(2001, 1, 1, 0));
        $result = $date->subMonths(1);
        $this->assertSame(testtime(2000, 12, 1, 0), $result->timestamp());
    }


    public function testAddYears1(): void
    {
        $date = new DateTime(testtime(2012, 5, 1));
        $result = $date->addYears(2);
        $this->assertSame(testtime(2014, 5, 1), $result->timestamp());
    }
    public function testAddYears2(): void
    {
        $date = new DateTime(testtime(2012, 2, 29));
        $result = $date->addYears(-2);
        $this->assertSame(testtime(2010, 2, 28), $result->timestamp());
    }


    public function testNextYear(): void
    {
        $date = new DateTime(testtime(1986, 31, 12, 23, 59, 59));
        $result = $date->addYears(1);
        $this->assertSame(testtime(1987, 31, 12, 23, 59, 59), $result->timestamp());
    }
    public function testPrevYear(): void
    {
        $date = new DateTime(testtime(2001, 1, 1, 0));
        $result = $date->subYears(1);
        $this->assertSame(testtime(2000, 1, 1, 0), $result->timestamp());
    }


    public function testAddSeconds1(): void
    {
        $date = new DateTime(testtime(2014, 3, 31));
        $result = $date->addSeconds(5);
        $this->assertSame(testtime(2014, 3, 31, 12, 0, 5), $result->timestamp());
    }
    public function testAddSeconds2(): void
    {
        $date = new DateTime(testtime(2014, 3, 31, 12, 0, 22));
        $result = $date->addSeconds(0);
        $this->assertSame(testtime(2014, 3, 31, 12, 0, 22), $result->timestamp());
    }


    public function testSubSeconds(): void
    {
        $date = new DateTime(testtime(2014, 3, 31));
        $result = $date->subSeconds(60);
        $this->assertSame(testtime(2014, 3, 31, 11, 59, 0), $result->timestamp());
    }


    public function testAddMinutes(): void
    {
        $date = new DateTime(testtime(1970, 3, 31, 23, 59, 59));
        $result = $date->addMinutes(5);
        $this->assertSame(testtime(1970, 4, 1, 0, 4, 59), $result->timestamp());
    }


    public function testSubMinutes(): void
    {
        $date = new DateTime(testtime(2012, 5, 1, 12, 10, 0));
        $result = $date->subMinutes(2);
        $this->assertSame(testtime(2012, 5, 1, 12, 8, 0), $result->timestamp());
    }


    public function testAddHours(): void
    {
        $date = new DateTime(testtime(1986, 12, 31, 23, 59, 59));
        $result = $date->addHours(1);
        $this->assertSame(testtime(1987, 1, 1, 0, 59, 59), $result->timestamp());
    }


    public function testSubHours(): void
    {
        $date = new DateTime(testtime(2012, 2, 29, 0));
        $result = $date->subHours(24);
        $this->assertSame(testtime(2012, 2, 28, 0), $result->timestamp());
    }
}
