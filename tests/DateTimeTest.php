<?php

namespace Regatta\Dates;

class DateTimeTest extends \PHPUnit_Framework_TestCase
{

    public function testConstructor1()
    {
        $unix = time() - 100;
        $date = new DateTime($unix);
        $this->assertSame($unix, $date->timestamp());
    }
    public function testConstructor2()
    {
        $this->setExpectedException("InvalidArgumentException", "An invalid unix timestamp was passed");
        $date = new DateTime(0);
    }
    public function testConstructor3()
    {
        $this->setExpectedException("InvalidArgumentException", "An invalid unix timestamp was passed");
        $date = new DateTime("ABC");
    }


    public function testFormat1()
    {
        $unix = time();
        $date = new DateTime($unix);
        $this->assertSame(date("d/m/y", $unix), $date->format("d/m/y"));
    }
    public function testFormat2()
    {
        $unix = time();
        $date = new DateTime($unix);
        $this->assertSame((int) date("Ymd", $unix), $date->format("Ymd"));
    }
    public function testNumeric()
    {
        $unix = time();
        $date = new DateTime($unix);
        $this->assertSame((int) date("Ymd", $unix), $date->numeric("Ymd"));
    }
    public function testString()
    {
        $unix = time();
        $date = new DateTime($unix);
        $this->assertSame(date("Ymd", $unix), $date->string("Ymd"));
    }


    public function testMiddayEarly()
    {
        $date = new DateTime(mktime(0, 0, 0, 1, 1, 2014));
        $this->assertSame(mktime(12, 0, 0, 1, 1, 2014), $date->midday());
    }
    public function testMiddayLate()
    {
        $date = new DateTime(mktime(23, 59, 59, 1, 1, 2014));
        $this->assertSame(mktime(12, 0, 0, 1, 1, 2014), $date->midday());
    }

    public function testStart()
    {
        $date = new DateTime(mktime(12, 0, 0, 1, 1, 2014));
        $this->assertSame(mktime(0, 0, 0, 1, 1, 2014), $date->start());
    }
    public function testEnd()
    {
        $date = new DateTime(mktime(12, 0, 0, 1, 1, 2014));
        $this->assertSame(mktime(23, 59, 59, 1, 1, 2014), $date->end());
    }


    public function testConstructor()
    {
        $unix = time();
        $date = DateTime::now();
        $this->assertSame($unix, $date->timestamp());
    }


    public function testParse1()
    {
        $input = "28/02/2008 06:30:12";
        $result = DateTime::parse($input)->format("d/m/Y H:i:s");
        $this->assertSame($input, $result);
    }
    public function testParse2()
    {
        $date = "1101231";
        $time = "042015";
        $result = DateTime::parse($date, $time)->format("1ymd His");
        $this->assertSame("{$date} {$time}", $result);
    }


    public function testFromFormat1()
    {
        $input = "28/02/2008 06:30:12";
        $format = "d/m/Y H:i:s";
        $result = DateTime::fromFormat($format, $input)->format($format);
        $this->assertSame($input, $result);
    }
    public function testFromFormat2()
    {
        $input = "March Mon 2 06/30 (2015)";
        $format = "F D j H/i (Y)";
        $result = DateTime::fromFormat($format, $input)->format($format);
        $this->assertSame($input, $result);
    }
    public function testFromFormat3()
    {
        $input = "60504";
        $format = "Gis";
        $result = DateTime::fromFormat($format, $input)->string($format);
        $this->assertSame($input, $result);
    }
    public function testFromFormat4()
    {
        $input = "20150923 60504";
        $format = "Ymd Gis";
        $result = DateTime::fromFormat($format, $input)->string($format);
        $this->assertSame($input, $result);
    }


    public function testMktime()
    {
        $date = DateTime::mktime(12, 0, 0, 7, 1, 2014);
        $this->assertSame(mktime(12, 0, 0, 7, 1, 2014), $date->timestamp());
    }


    public function testWithYear()
    {
        $date = DateTime::mktime(11, 30, 59, 2, 29, 2016);
        $date = $date->withYear(2017);
        $this->assertSame("2017-02-28 11:30:59", $date->format("Y-m-d H:i:s"));
    }


    public function testWithMonth()
    {
        $date = DateTime::mktime(11, 30, 59, 8, 31, 2016);
        $date = $date->withMonth(9);
        $this->assertSame("2016-09-30 11:30:59", $date->format("Y-m-d H:i:s"));
    }


    public function testWithDay()
    {
        $date = DateTime::mktime(11, 30, 59, 2, 20, 2016);
        $date = $date->withDay(10);
        $this->assertSame("2016-02-10 11:30:59", $date->format("Y-m-d H:i:s"));
    }
    public function testWithInvalidDay()
    {
        $this->setExpectedException(\UnexpectedValueException::class, "Unable to set the day to 30 as this month only has 29 days, use withMonth() first");
        $date = DateTime::mktime(11, 30, 59, 2, 20, 2016);
        $date = $date->withDay(30);
    }


    public function testWithHours()
    {
        $date = DateTime::mktime(11, 30, 59, 2, 20, 2016);
        $date = $date->withHours(10);
        $this->assertSame("2016-02-20 10:30:59", $date->format("Y-m-d H:i:s"));
    }


    public function testWithMinutes()
    {
        $date = DateTime::mktime(11, 30, 59, 2, 20, 2016);
        $date = $date->withMinutes(10);
        $this->assertSame("2016-02-20 11:10:59", $date->format("Y-m-d H:i:s"));
    }


    public function testWithSeconds()
    {
        $date = DateTime::mktime(11, 30, 59, 2, 20, 2016);
        $date = $date->withSeconds(10);
        $this->assertSame("2016-02-20 11:30:10", $date->format("Y-m-d H:i:s"));
    }
}
