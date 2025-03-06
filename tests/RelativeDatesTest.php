<?php

namespace duncan3dc\DateTests;

use duncan3dc\Dates\Date;
use PHPUnit\Framework\TestCase;

final class RelativeDatesTest extends TestCase
{
    public function testAddDays1(): void
    {
        $date = new Date(testtime(2014, 3, 31));
        $result = $date->addDays(2);
        $this->assertSame(testtime(2014, 4, 2), $result->timestamp());
    }
    public function testAddDays2(): void
    {
        $date = new Date(testtime(2012, 1, 1));
        $result = $date->addDays(-2);
        $this->assertSame(testtime(2011, 12, 30), $result->timestamp());
    }
    public function testAddDays3(): void
    {
        $date = new Date(testtime(2014, 6, 7));
        $result = $date->addDays(0);
        $this->assertSame(testtime(2014, 6, 7), $result->timestamp());
    }


    public function testSubDays(): void
    {
        $date = new Date(testtime(2014, 4, 2));
        $result = $date->subDays(2);
        $this->assertSame(testtime(2014, 3, 31), $result->timestamp());
    }


    public function testNextDay(): void
    {
        $date = new Date(testtime(1970, 3, 31, 23, 59, 59));
        $result = $date->addDays(1);
        $this->assertSame(testtime(1970, 4, 1), $result->timestamp());
    }
    public function testPrevDay(): void
    {
        $date = new Date(testtime(2001, 1, 1, 0));
        $result = $date->subDays(1);
        $this->assertSame(testtime(2000, 12, 31), $result->timestamp());
    }


    public function testAddMonths1(): void
    {
        $date = new Date(testtime(2014, 3, 31));
        $result = $date->addMonths(2);
        $this->assertSame(testtime(2014, 5, 31), $result->timestamp());
    }
    public function testAddMonths2(): void
    {
        $date = new Date(testtime(2012, 1, 31));
        $result = $date->addMonths(-2);
        $this->assertSame(testtime(2011, 11, 30), $result->timestamp());
    }
    public function testAddMonths3(): void
    {
        $date = new Date(testtime(2012, 2, 20));
        $result = $date->addMonths(0);
        $this->assertSame(testtime(2012, 2, 20), $result->timestamp());
    }


    public function testSubMonths(): void
    {
        $date = new Date(testtime(2014, 5, 31));
        $result = $date->subMonths(2);
        $this->assertSame(testtime(2014, 3, 31), $result->timestamp());
    }


    public function testNextMonth(): void
    {
        $date = new Date(testtime(1970, 3, 31, 23, 59, 59));
        $result = $date->addMonths(1);
        $this->assertSame(testtime(1970, 4, 30), $result->timestamp());
    }
    public function testPrevMonth(): void
    {
        $date = new Date(testtime(2001, 1, 1, 0));
        $result = $date->subMonths(1);
        $this->assertSame(testtime(2000, 12, 1), $result->timestamp());
    }


    public function testAddYears1(): void
    {
        $date = new Date(testtime(2012, 5, 1));
        $result = $date->addYears(2);
        $this->assertSame(testtime(2014, 5, 1), $result->timestamp());
    }
    public function testAddYears2(): void
    {
        $date = new Date(testtime(2012, 2, 29));
        $result = $date->addYears(-2);
        $this->assertSame(testtime(2010, 2, 28), $result->timestamp());
    }


    public function testSubYears(): void
    {
        $date = new Date(testtime(2014, 5, 1));
        $result = $date->subYears(2);
        $this->assertSame(testtime(2012, 5, 1), $result->timestamp());
    }


    public function testNextYear(): void
    {
        $date = new Date(testtime(1986, 31, 12, 23, 59, 59));
        $result = $date->addYears(1);
        $this->assertSame(testtime(1987, 31, 12), $result->timestamp());
    }
    public function testPrevYear(): void
    {
        $date = new Date(testtime(2001, 1, 1, 0));
        $result = $date->subYears(1);
        $this->assertSame(testtime(2000, 1, 1), $result->timestamp());
    }
}
