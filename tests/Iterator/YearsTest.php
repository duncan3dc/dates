<?php

namespace Regatta\Dates\Iterator;

use Regatta\Dates\DateTime;
use Regatta\Dates\Range;

class YearsTest extends \PHPUnit_Framework_TestCase
{

    public function assertRangeYears($years, $start, $end)
    {
        $start = new DateTime($start);
        $end = new DateTime($end);
        $range = new Range($start, $end);
        $count = 0;
        foreach ($range->years() as $date) {
            $this->assertInstanceOf("Regatta\\Dates\\DateTime", $date);
            ++$count;
        }
        $this->assertSame($years, $count);
    }


    public function test1Year()
    {
        $this->assertRangeYears(2, mktime(12, 0, 0, 6, 15, 2014), mktime(12, 0, 0, 6, 15, 2015));
    }


    public function testLateStartDate()
    {
        $this->assertRangeYears(1, mktime(12, 0, 0, 6, 15, 2014), mktime(23, 59, 59, 12, 31, 2014));
    }


    public function testLateEndDate()
    {
        $this->assertRangeYears(2, mktime(12, 0, 0, 6, 15, 2014), mktime(23, 59, 59, 12, 31, 2015));
    }


    public function testLateDates()
    {
        $this->assertRangeYears(3, mktime(23, 59, 59, 12, 31, 2014), mktime(23, 59, 59, 12, 31, 2016));
    }
}
