<?php

namespace duncan3dc\DateTests;

use duncan3dc\Dates\NullDateTime;

class NullDateTimeTest extends \PHPUnit_Framework_TestCase
{
    protected $date;

    public function setUp()
    {
        $this->date = new NullDateTime;
    }


    public function testConstructor()
    {
        $date = new NullDateTime(time());
        $this->assertSame(0, $date->timestamp());
    }


    public function testFormat()
    {
        $this->assertSame("n/a", $this->date->format("d/m/y"));
    }


    public function testMidday()
    {
        $this->assertSame(0, $this->date->midday());
    }


    public function testStart()
    {
        $this->assertSame(0, $this->date->start());
    }


    public function testEnd()
    {
        $this->assertSame(0, $this->date->end());
    }


    public function testIsBankHoliday()
    {
        $this->assertFalse($this->date->isBankHoliday());
    }


    public function testIsMonday()
    {
        $this->assertFalse($this->date->isMonday());
    }


    public function testIsTuesday()
    {
        $this->assertFalse($this->date->isTuesday());
    }


    public function testIsWednesday()
    {
        $this->assertFalse($this->date->isWednesday());
    }


    public function testIsThursday()
    {
        $this->assertFalse($this->date->isThursday());
    }


    public function testIsFriday()
    {
        $this->assertFalse($this->date->isFriday());
    }


    public function testIsSaturday()
    {
        $this->assertFalse($this->date->isSaturday());
    }


    public function testIsSunday()
    {
        $this->assertFalse($this->date->isSunday());
    }


    public function testIsWeekend()
    {
        $this->assertFalse($this->date->isWeekend());
    }


    public function testIsWeekday()
    {
        $this->assertFalse($this->date->isWeekday());
    }


    public function testFormatPeriod()
    {
        $this->assertSame("n/a", $this->date->formatPeriod("y"));
    }


    public function testFinancialYear()
    {
        $this->assertSame(0, $this->date->getFinancialYear());
    }


    public function testFinancialPeriod()
    {
        $this->assertSame(0, $this->date->getFinancialPeriod());
    }


    public function testAddDays()
    {
        $this->assertSame($this->date, $this->date->addDays(2));
    }


    public function testSubDays()
    {
        $this->assertSame($this->date, $this->date->subDays(1));
    }


    public function testAddMonths()
    {
        $this->assertSame($this->date, $this->date->addMonths(1));
    }


    public function testSubMonths()
    {
        $this->assertSame($this->date, $this->date->subMonths(3));
    }


    public function testAddYears()
    {
        $this->assertSame($this->date, $this->date->addYears(3));
    }


    public function testSubYears()
    {
        $this->assertSame($this->date, $this->date->subYears(17));
    }


    public function testAddSeconds()
    {
        $this->assertSame($this->date, $this->date->addSeconds(4));
    }


    public function testSubSeconds()
    {
        $this->assertSame($this->date, $this->date->subSeconds(8));
    }


    public function testAddMinutes()
    {
        $this->assertSame($this->date, $this->date->addMinutes(22));
    }


    public function testSubMinutes()
    {
        $this->assertSame($this->date, $this->date->subMinutes(84));
    }


    public function testAddHours()
    {
        $this->assertSame($this->date, $this->date->addHours(6));
    }


    public function testSubHours()
    {
        $this->assertSame($this->date, $this->date->subHours(87));
    }
}
