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
        $unix = time();
        $date = new DateTime;
        $this->assertSame($unix, $date->timestamp());
    }
    public function testConstructor3()
    {
        $this->setExpectedException("InvalidArgumentException", "An invalid unix timestamp was passed");
        $date = new DateTime(0);
    }
    public function testConstructor4()
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
}
