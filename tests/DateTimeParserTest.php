<?php

namespace duncan3dc\DateTests;

use duncan3dc\Dates\DateTimeParser;

class DateTimeParserTest extends \PHPUnit_Framework_TestCase
{
    protected $dates = [
        "Y-m-d"         =>  "2008-02-22",
        "Y-m-d H:i:s"   =>  "2010-04-30 05:33:21",
        "d/m/Y"         =>  "28/02/2008",
        "d/m/y"         =>  "31/01/97",
        "d/m/Y H:i:s"   =>  "28/02/2008 06:30:12",
        "d/m/y H:i:s"   =>  "31/01/97 23:12:00",
        "d/m/Y H:i"     =>  "24/10/1986 14:45",
        "YmdHi"         =>  200905220004,
        "YmdHis"        =>  20060830073359,
        "Ymd"           =>  20080222,
        "Ymd His"       =>  "20100430 021007",
        "Ymd Gis"       =>  "20110101 20003",
        "d-m-Y"         =>  "04-07-2008",
        "d-m-y"         =>  "08-10-13",
        "1ymd"          =>  1070420,
        "1ymd His"      =>  "1101231 042015",
        "1ymd Gis"      =>  "1110615 40004",
        "Y-m-d-H.i.s.u" =>  "2014-02-11-22.54.04.000000",
    ];

    public function testFormats()
    {
        foreach ($this->dates as $format => $test) {
            $result = DateTimeParser::create($test)->format($format);
            $this->assertSame($test, $result);
        }
    }

    public function testSeparateTime()
    {
        foreach ($this->dates as $format => $test) {
            if (!strpos($format, " ")) {
                continue;
            }

            list($date, $time) = explode(" ", $test);
            $result = DateTimeParser::create($date, $time)->format($format);
            $this->assertSame($test, $result);
        }
    }
}
