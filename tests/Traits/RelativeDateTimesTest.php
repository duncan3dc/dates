<?php

namespace duncan3dc\DateTests\Traits;

use duncan3dc\Dates\DateTime;
use PHPUnit\Framework\TestCase;

final class RelativeDateTimesTest extends TestCase
{
    public function testAddWeeks1(): void
    {
        $date = new DateTime(mktime(12, 0, 0, 2, 28, 2013));
        $result = $date->addWeeks(2);
        $this->assertSame(mktime(12, 0, 0, 3, 14, 2013), $result->timestamp());
    }
    public function testAddWeeks2(): void
    {
        $date = new DateTime(mktime(12, 0, 0, 2, 28, 2013));
        $result = $date->addWeeks(-2);
        $this->assertSame(mktime(12, 0, 0, 2, 14, 2013), $result->timestamp());
    }
    public function testAddWeeks3(): void
    {
        $date = new DateTime(mktime(12, 0, 0, 2, 28, 2013));
        $result = $date->addWeeks(0);
        $this->assertSame($date, $result);
    }
    public function testSubWeeks1(): void
    {
        $date = new DateTime(mktime(12, 0, 0, 10, 2, 2014));
        $result = $date->subWeeks(2);
        $this->assertSame(mktime(12, 0, 0, 9, 18, 2014), $result->timestamp());
    }
    public function testSubWeeks2(): void
    {
        $date = new DateTime(mktime(12, 0, 0, 10, 2, 2013));
        $result = $date->subWeeks(-2);
        $this->assertSame(mktime(12, 0, 0, 10, 16, 2013), $result->timestamp());
    }


    public function testAddMonths1(): void
    {
        $date = new DateTime(mktime(12, 0, 0, 3, 31, 2014));
        $result = $date->addMonths(2);
        $this->assertSame(mktime(12, 0, 0, 5, 31, 2014), $result->timestamp());
    }
    public function testAddMonths2(): void
    {
        $date = new DateTime(mktime(12, 0, 0, 1, 31, 2012));
        $result = $date->addMonths(-2);
        $this->assertSame(mktime(12, 0, 0, 11, 30, 2011), $result->timestamp());
    }


    public function testNextMonth(): void
    {
        $date = new DateTime(mktime(23, 59, 59, 3, 31, 1970));
        $result = $date->addMonths(1);
        $this->assertSame(mktime(23, 59, 59, 4, 30, 1970), $result->timestamp());
    }
    public function testPrevMonth(): void
    {
        $date = new DateTime(mktime(0, 0, 0, 1, 1, 2001));
        $result = $date->subMonths(1);
        $this->assertSame(mktime(0, 0, 0, 12, 1, 2000), $result->timestamp());
    }


    public function testAddYears1(): void
    {
        $date = new DateTime(mktime(12, 0, 0, 5, 1, 2012));
        $result = $date->addYears(2);
        $this->assertSame(mktime(12, 0, 0, 5, 1, 2014), $result->timestamp());
    }
    public function testAddYears2(): void
    {
        $date = new DateTime(mktime(12, 0, 0, 2, 29, 2012));
        $result = $date->addYears(-2);
        $this->assertSame(mktime(12, 0, 0, 2, 28, 2010), $result->timestamp());
    }


    public function testNextYear(): void
    {
        $date = new DateTime(mktime(23, 59, 59, 31, 12, 1986));
        $result = $date->addYears(1);
        $this->assertSame(mktime(23, 59, 59, 31, 12, 1987), $result->timestamp());
    }
    public function testPrevYear(): void
    {
        $date = new DateTime(mktime(0, 0, 0, 1, 1, 2001));
        $result = $date->subYears(1);
        $this->assertSame(mktime(0, 0, 0, 1, 1, 2000), $result->timestamp());
    }


    public function testAddSeconds1(): void
    {
        $date = new DateTime(mktime(12, 0, 0, 3, 31, 2014));
        $result = $date->addSeconds(5);
        $this->assertSame(mktime(12, 0, 5, 3, 31, 2014), $result->timestamp());
    }
    public function testAddSeconds2(): void
    {
        $date = new DateTime(mktime(12, 0, 22, 3, 31, 2014));
        $result = $date->addSeconds(0);
        $this->assertSame(mktime(12, 0, 22, 3, 31, 2014), $result->timestamp());
    }


    public function testSubSeconds(): void
    {
        $date = new DateTime(mktime(12, 0, 0, 3, 31, 2014));
        $result = $date->subSeconds(60);
        $this->assertSame(mktime(11, 59, 0, 3, 31, 2014), $result->timestamp());
    }


    public function testAddMinutes(): void
    {
        $date = new DateTime(mktime(23, 59, 59, 3, 31, 1970));
        $result = $date->addMinutes(5);
        $this->assertSame(mktime(0, 4, 59, 4, 1, 1970), $result->timestamp());
    }


    public function testSubMinutes(): void
    {
        $date = new DateTime(mktime(12, 10, 0, 5, 1, 2012));
        $result = $date->subMinutes(2);
        $this->assertSame(mktime(12, 8, 0, 5, 1, 2012), $result->timestamp());
    }


    public function testAddHours(): void
    {
        $date = new DateTime(mktime(23, 59, 59, 12, 31, 1986));
        $result = $date->addHours(1);
        $this->assertSame(mktime(0, 59, 59, 1, 1, 1987), $result->timestamp());
    }


    public function testSubHours(): void
    {
        $date = new DateTime(mktime(0, 0, 0, 2, 29, 2012));
        $result = $date->subHours(24);
        $this->assertSame(mktime(0, 0, 0, 2, 28, 2012), $result->timestamp());
    }
}
