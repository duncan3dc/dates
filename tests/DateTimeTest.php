<?php

namespace duncan3dc\DateTests;

use duncan3dc\Dates\DateTime;

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


    public function testNow()
    {
        $unix = time();
        $date = DateTime::now();
        $this->assertSame($unix, $date->timestamp());
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


    public function testConstructor()
    {
        $unix = time();
        $date = DateTime::now();
        $this->assertSame($unix, $date->timestamp());
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


    public function dateFormatProvider()
    {
        $dates = [
            "28/02/2008 06:30:12"       =>  "d/m/Y H:i:s",
            "March Mon 2 06/30 (2015)"  =>  "F D j H/i (Y)",
        ];
        foreach ($dates as $input => $format) {
            yield [$input, $format];
        }
    }
    /**
     * @dataProvider dateFormatProvider
     */
    public function testFromFormat($input, $format)
    {
        $result = DateTime::fromFormat($format, $input)->format($format);
        $this->assertSame($input, $result);
    }


    public function testFromFormatFail()
    {
        $this->setExpectedException("InvalidArgumentException", "Invalid date (2015) does not conform to format (y)");
        DateTime::fromFormat("y", "2015");
    }


    public function testMktime()
    {
        $date = DateTime::mktime(12, 0, 0, 7, 1, 2014);
        $this->assertSame(mktime(12, 0, 0, 7, 1, 2014), $date->timestamp());
    }
}
