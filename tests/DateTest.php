<?php

namespace duncan3dc\DateTests;

use duncan3dc\Dates\Date;

class DateTest extends \PHPUnit_Framework_TestCase
{

    public function testNow()
    {
        $date = Date::now();
        $this->assertSame(mktime(12, 0, 0, date("n"), date("j"), date("Y")), $date->timestamp());
    }
}
