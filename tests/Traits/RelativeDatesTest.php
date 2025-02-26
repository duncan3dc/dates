<?php

namespace duncan3dc\DateTests\Traits;

use duncan3dc\Dates\Date;
use PHPUnit\Framework\TestCase;

final class RelativeDatesTest extends TestCase
{
    public function testAddDays1(): void
    {
        $date = new Date(mktime(12, 0, 0, 3, 31, 2014));
        $result = $date->addDays(2);
        $this->assertSame(mktime(12, 0, 0, 4, 2, 2014), $result->timestamp());
    }
    public function testAddDays2(): void
    {
        $date = new Date(mktime(12, 0, 0, 1, 1, 2012));
        $result = $date->addDays(-2);
        $this->assertSame(mktime(12, 0, 0, 12, 30, 2011), $result->timestamp());
    }
    public function testAddDays3(): void
    {
        $date = new Date(mktime(12, 0, 0, 6, 7, 2014));
        $result = $date->addDays(0);
        $this->assertSame(mktime(12, 0, 0, 6, 7, 2014), $result->timestamp());
    }


    public function testSubDays(): void
    {
        $date = new Date(mktime(12, 0, 0, 4, 2, 2014));
        $result = $date->subDays(2);
        $this->assertSame(mktime(12, 0, 0, 3, 31, 2014), $result->timestamp());
    }


    public function testNextDay(): void
    {
        $date = new Date(mktime(23, 59, 59, 3, 31, 1970));
        $result = $date->addDays(1);
        $this->assertSame(mktime(12, 0, 0, 4, 1, 1970), $result->timestamp());
    }
    public function testPrevDay(): void
    {
        $date = new Date(mktime(0, 0, 0, 1, 1, 2001));
        $result = $date->subDays(1);
        $this->assertSame(mktime(12, 0, 0, 12, 31, 2000), $result->timestamp());
    }


    public function testAddMonths1(): void
    {
        $date = new Date(mktime(12, 0, 0, 3, 31, 2014));
        $result = $date->addMonths(2);
        $this->assertSame(mktime(12, 0, 0, 5, 31, 2014), $result->timestamp());
    }
    public function testAddMonths2(): void
    {
        $date = new Date(mktime(12, 0, 0, 1, 31, 2012));
        $result = $date->addMonths(-2);
        $this->assertSame(mktime(12, 0, 0, 11, 30, 2011), $result->timestamp());
    }
    public function testAddMonths3(): void
    {
        $date = new Date(mktime(12, 0, 0, 2, 20, 2012));
        $result = $date->addMonths(0);
        $this->assertSame(mktime(12, 0, 0, 2, 20, 2012), $result->timestamp());
    }


    public function testSubMonths(): void
    {
        $date = new Date(mktime(12, 0, 0, 5, 31, 2014));
        $result = $date->subMonths(2);
        $this->assertSame(mktime(12, 0, 0, 3, 31, 2014), $result->timestamp());
    }


    public function testNextMonth(): void
    {
        $date = new Date(mktime(23, 59, 59, 3, 31, 1970));
        $result = $date->addMonths(1);
        $this->assertSame(mktime(12, 0, 0, 4, 30, 1970), $result->timestamp());
    }
    public function testPrevMonth(): void
    {
        $date = new Date(mktime(0, 0, 0, 1, 1, 2001));
        $result = $date->subMonths(1);
        $this->assertSame(mktime(12, 0, 0, 12, 1, 2000), $result->timestamp());
    }


    public function testAddYears1(): void
    {
        $date = new Date(mktime(12, 0, 0, 5, 1, 2012));
        $result = $date->addYears(2);
        $this->assertSame(mktime(12, 0, 0, 5, 1, 2014), $result->timestamp());
    }
    public function testAddYears2(): void
    {
        $date = new Date(mktime(12, 0, 0, 2, 29, 2012));
        $result = $date->addYears(-2);
        $this->assertSame(mktime(12, 0, 0, 2, 28, 2010), $result->timestamp());
    }


    public function testSubYears(): void
    {
        $date = new Date(mktime(12, 0, 0, 5, 1, 2014));
        $result = $date->subYears(2);
        $this->assertSame(mktime(12, 0, 0, 5, 1, 2012), $result->timestamp());
    }


    public function testNextYear(): void
    {
        $date = new Date(mktime(23, 59, 59, 31, 12, 1986));
        $result = $date->addYears(1);
        $this->assertSame(mktime(12, 0, 0, 31, 12, 1987), $result->timestamp());
    }
    public function testPrevYear(): void
    {
        $date = new Date(mktime(0, 0, 0, 1, 1, 2001));
        $result = $date->subYears(1);
        $this->assertSame(mktime(12, 0, 0, 1, 1, 2000), $result->timestamp());
    }
}
