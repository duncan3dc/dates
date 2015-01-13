<?php

namespace duncan3dc\DateTests;

use duncan3dc\Dates\DateTime;

class RelativeDatesTest extends \PHPUnit_Framework_TestCase
{

    public function testAddMonths1()
    {
        $date = new DateTime(mktime(12, 0, 0, 3, 31, 2014));
        $result = $date->addMonths(2);
        $this->assertSame(mktime(12, 0, 0, 5, 31, 2014), $result->timestamp());
    }
    public function testAddMonths2()
    {
        $date = new DateTime(mktime(12, 0, 0, 1, 31, 2012));
        $result = $date->addMonths(-2);
        $this->assertSame(mktime(12, 0, 0, 11, 30, 2011), $result->timestamp());
    }


    public function testNextMonth()
    {
        $date = new DateTime(mktime(23, 59, 59, 3, 31, 1970));
        $result = $date->nextMonth();
        $this->assertSame(mktime(12, 0, 0, 4, 30, 1970), $result->timestamp());
    }
    public function testPrevMonth()
    {
        $date = new DateTime(mktime(0, 0, 0, 1, 1, 2001));
        $result = $date->prevMonth();
        $this->assertSame(mktime(12, 0, 0, 12, 1, 2000), $result->timestamp());
    }


    public function testAddYears1()
    {
        $date = new DateTime(mktime(12, 0, 0, 5, 1, 2012));
        $result = $date->addYears(2);
        $this->assertSame(mktime(12, 0, 0, 5, 1, 2014), $result->timestamp());
    }
    public function testAddYears2()
    {
        $date = new DateTime(mktime(12, 0, 0, 2, 29, 2012));
        $result = $date->addYears(-2);
        $this->assertSame(mktime(12, 0, 0, 2, 28, 2010), $result->timestamp());
    }


    public function testNextYear()
    {
        $date = new DateTime(mktime(23, 59, 59, 31, 12, 1986));
        $result = $date->nextYear();
        $this->assertSame(mktime(12, 0, 0, 31, 12, 1987), $result->timestamp());
    }
    public function testPrevYear()
    {
        $date = new DateTime(mktime(0, 0, 0, 1, 1, 2001));
        $result = $date->prevYear();
        $this->assertSame(mktime(12, 0, 0, 1, 1, 2000), $result->timestamp());
    }
}
