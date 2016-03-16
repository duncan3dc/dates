<?php

namespace Regatta\Dates\Iterator;

use Regatta\Dates\DateTime;
use Regatta\Dates\Range;

class SecondsTest extends \PHPUnit_Framework_TestCase
{

    public function assertRangeSeconds($seconds, $start, $end)
    {
        $start = new DateTime($start);
        $end = new DateTime($end);
        $range = new Range($start, $end);
        $count = 0;
        foreach ($range->seconds() as $date) {
            $this->assertInstanceOf("Regatta\\Dates\\DateTime", $date);
            ++$count;
        }
        $this->assertSame($seconds, $count);
    }


    public function testSameTime()
    {
        $this->assertRangeSeconds(1, mktime(12, 0, 0, 3, 20, 2014), mktime(12, 0, 0, 3, 20, 2014));
    }


    public function test1Second()
    {
        $this->assertRangeSeconds(2, mktime(12, 0, 0, 3, 20, 2014), mktime(12, 0, 1, 3, 20, 2014));
    }


    public function test1Minute()
    {
        $this->assertRangeSeconds(61, mktime(12, 0, 0, 1, 1, 2014), mktime(12, 1, 0, 1, 1, 2014));
    }
}
