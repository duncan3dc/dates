<?php

namespace Regatta\Dates;

class DateTest extends \PHPUnit_Framework_TestCase
{

    public function testConstructor()
    {
        $unix = time();
        $datetime = new DateTime($unix);
        $date = new Date($unix);
        $this->assertSame($datetime->midday(), $date->timestamp());
    }


    public function testParse()
    {
        $input = "2008-02-22";
        $result = Date::parse($input)->format("Y-m-d");
        $this->assertSame($input, $result);
    }
}
