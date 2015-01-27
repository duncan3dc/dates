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


    public function testMktime()
    {
        $date = DateTime::mktime(12, 0, 0, 1, 1, 2014);
        $this->assertSame(mktime(12, 0, 0, 1, 1, 2014), $date->timestamp());
    }
}
