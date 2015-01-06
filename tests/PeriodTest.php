<?php

namespace Regatta\Dates;

class PeriodTest extends \PHPUnit_Framework_TestCase
{

    public function testPeriodYear1()
    {
        $unix = mktime(12, 0, 0, 2, 1, 2014);
        $date = new DateTime($unix);
        $this->assertSame(2014, $date->getFinancialYear());
    }
    public function testPeriodYear2()
    {
        $unix = mktime(12, 0, 0, 1, 1, 2014);
        $date = new DateTime($unix);
        $this->assertSame(2013, $date->getFinancialYear());
    }
    public function testPeriodYear3()
    {
        $unix = mktime(12, 0, 0, 12, 1, 2014);
        $date = new DateTime($unix);
        $this->assertSame(2014, $date->getFinancialYear());
    }


    public function testPeriodNumber1()
    {
        $unix = mktime(12, 0, 0, 2, 1, 2014);
        $date = new DateTime($unix);
        $this->assertSame(1, $date->getFinancialPeriod());
    }
    public function testPeriodNumber2()
    {
        $unix = mktime(12, 0, 0, 12, 1, 2014);
        $date = new DateTime($unix);
        $this->assertSame(11, $date->getFinancialPeriod());
    }
    public function testPeriodNumber3()
    {
        $unix = mktime(12, 0, 0, 1, 1, 2014);
        $date = new DateTime($unix);
        $this->assertSame(12, $date->getFinancialPeriod());
    }
}
