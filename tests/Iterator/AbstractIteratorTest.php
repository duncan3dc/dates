<?php

namespace Regatta\Dates\Iterator;

use Regatta\Dates\Date;
use Regatta\Dates\Range;

class AbstractIteratorTest extends \PHPUnit_Framework_TestCase
{

    public function testCurrent()
    {
        $date = Date::now();
        $range = new Range($date, $date);
        $count = 0;
        $iterator = $range->days();
        foreach ($iterator as $key => $date) {
            ++$count;
        }
        $this->assertSame(1, $count);
    }
}
