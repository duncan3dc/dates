<?php

namespace Regatta\Dates;

class RangeTest extends \PHPUnit_Framework_TestCase
{

    public function testGetStart()
    {
        $start = new Now;
        $end = new Now;
        $range = new Range($start, $end);
        $this->assertSame($start, $range->getStart());
    }


    public function testGetEnd()
    {
        $start = new Now;
        $end = new Now;
        $range = new Range($start, $end);
        $this->assertSame($end, $range->getEnd());
    }
}
