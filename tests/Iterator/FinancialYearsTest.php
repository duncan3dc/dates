<?php

namespace Regatta\Dates\Iterator;

use Regatta\Dates\DateTime;
use Regatta\Dates\Range;

class FinancialYearsTest extends \PHPUnit_Framework_TestCase
{

    public function assertRangeFinancialYears($years, $start, $end)
    {
        $start = new DateTime($start);
        $end = new DateTime($end);
        $range = new Range($start, $end);
        $count = 0;
        foreach ($range->financialYears() as $date) {
            $this->assertInstanceOf("Regatta\\Dates\\FinancialYear", $date);
            ++$count;
        }
        $this->assertSame($years, $count);
    }


    public function test1Year()
    {
        $this->assertRangeFinancialYears(2, mktime(12, 0, 0, 6, 15, 2014), mktime(12, 0, 0, 6, 15, 2015));
    }


    public function testLateStartDate()
    {
        $this->assertRangeFinancialYears(1, mktime(12, 0, 0, 6, 15, 2014), mktime(23, 59, 59, 12, 31, 2014));
    }


    public function testLateEndDate()
    {
        $this->assertRangeFinancialYears(2, mktime(12, 0, 0, 6, 15, 2014), mktime(23, 59, 59, 12, 31, 2015));
    }


    public function testLateDates()
    {
        $this->assertRangeFinancialYears(3, mktime(23, 59, 59, 12, 31, 2014), mktime(23, 59, 59, 12, 31, 2016));
    }
}
