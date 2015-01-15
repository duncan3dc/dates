<?php

namespace Regatta\Dates;

class RelativeDatesTest extends \PHPUnit_Framework_TestCase
{

    public function testAddDays1()
    {
        $date = new Date(mktime(12, 0, 0, 3, 31, 2014));
        $result = $date->addDays(2);
        $this->assertSame(mktime(12, 0, 0, 4, 2, 2014), $result->asUnix());
    }
    public function testAddDays2()
    {
        $date = new Date(mktime(12, 0, 0, 1, 1, 2012));
        $result = $date->addDays(-2);
        $this->assertSame(mktime(12, 0, 0, 12, 30, 2011), $result->asUnix());
    }


    public function testNextDay()
    {
        $date = new Date(mktime(23, 59, 59, 3, 31, 1970));
        $result = $date->nextDay();
        $this->assertSame(mktime(12, 0, 0, 4, 1, 1970), $result->asUnix());
    }
    public function testPreviousDay()
    {
        $date = new Date(mktime(0, 0, 0, 1, 1, 2001));
        $result = $date->PreviousDay();
        $this->assertSame(mktime(12, 0, 0, 12, 31, 2000), $result->asUnix());
    }


    public function testAddMonths1()
    {
        $date = new Date(mktime(12, 0, 0, 3, 31, 2014));
        $result = $date->addMonths(2);
        $this->assertSame(mktime(12, 0, 0, 5, 31, 2014), $result->asUnix());
    }
    public function testAddMonths2()
    {
        $date = new Date(mktime(12, 0, 0, 1, 31, 2012));
        $result = $date->addMonths(-2);
        $this->assertSame(mktime(12, 0, 0, 11, 30, 2011), $result->asUnix());
    }


    public function testNextMonth()
    {
        $date = new Date(mktime(23, 59, 59, 3, 31, 1970));
        $result = $date->nextMonth();
        $this->assertSame(mktime(12, 0, 0, 4, 30, 1970), $result->asUnix());
    }
    public function testPreviousMonth()
    {
        $date = new Date(mktime(0, 0, 0, 1, 1, 2001));
        $result = $date->PreviousMonth();
        $this->assertSame(mktime(12, 0, 0, 12, 1, 2000), $result->asUnix());
    }


    public function testAddYears1()
    {
        $date = new Date(mktime(12, 0, 0, 5, 1, 2012));
        $result = $date->addYears(2);
        $this->assertSame(mktime(12, 0, 0, 5, 1, 2014), $result->asUnix());
    }
    public function testAddYears2()
    {
        $date = new Date(mktime(12, 0, 0, 2, 29, 2012));
        $result = $date->addYears(-2);
        $this->assertSame(mktime(12, 0, 0, 2, 28, 2010), $result->asUnix());
    }


    public function testNextYear()
    {
        $date = new Date(mktime(23, 59, 59, 31, 12, 1986));
        $result = $date->nextYear();
        $this->assertSame(mktime(12, 0, 0, 31, 12, 1987), $result->asUnix());
    }
    public function testPreviousYear()
    {
        $date = new Date(mktime(0, 0, 0, 1, 1, 2001));
        $result = $date->PreviousYear();
        $this->assertSame(mktime(12, 0, 0, 1, 1, 2000), $result->asUnix());
    }
}