<?php

namespace duncan3dc\DateTests;

use duncan3dc\Dates\DateParser;

class DateParserTest extends \PHPUnit_Framework_TestCase
{
    protected $dates = [
        "Y-m-d"         =>  "2008-02-22",
        "d/m/Y"         =>  "28/02/2008",
        "d/m/y"         =>  "31/01/97",
        "Ymd"           =>  20080222,
        "d-m-Y"         =>  "04-07-2008",
        "d-m-y"         =>  "08-10-13",
        "1ymd"          =>  1070420,
    ];

    public function testFormats()
    {
        $parser = new DateParser();
        $parser->addDefaultParsers();

        foreach ($this->dates as $format => $test) {
            $result = $parser->parse($test)->format($format);
            $this->assertSame($test, $result);
        }
    }

    public function testUnparsable()
    {
        $parser = new DateParser();

        error_reporting(\E_ALL ^ \E_WARNING);
        $this->setExpectedException("InvalidArgumentException", "An unparsable date was passed (/)");
        $parser->parse("/");
    }
}
