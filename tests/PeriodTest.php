<?php

namespace Regatta\Dates;

class PeriodTest extends \PHPUnit_Framework_TestCase
{

    public function testFinancialYear1()
    {
        $unix = mktime(12, 0, 0, 2, 1, 2014);
        $date = new DateTime($unix);
        $this->assertSame(2014, $date->getFinancialYear());
    }
    public function testFinancialYear2()
    {
        $unix = mktime(12, 0, 0, 1, 1, 2014);
        $date = new DateTime($unix);
        $this->assertSame(2013, $date->getFinancialYear());
    }
    public function testFinancialYear3()
    {
        $unix = mktime(12, 0, 0, 12, 1, 2014);
        $date = new DateTime($unix);
        $this->assertSame(2014, $date->getFinancialYear());
    }


    public function testFinancialPeriod1()
    {
        $unix = mktime(12, 0, 0, 2, 1, 2014);
        $date = new DateTime($unix);
        $this->assertSame(1, $date->getFinancialPeriod());
    }
    public function testFinancialPeriod2()
    {
        $unix = mktime(12, 0, 0, 12, 1, 2014);
        $date = new DateTime($unix);
        $this->assertSame(11, $date->getFinancialPeriod());
    }
    public function testFinancialPeriod3()
    {
        $unix = mktime(12, 0, 0, 1, 1, 2014);
        $date = new DateTime($unix);
        $this->assertSame(12, $date->getFinancialPeriod());
    }
    public function testFinancialPeriod4()
    {
        $unix = mktime(12, 0, 0, 7, 31, 2014);
        $date = new DateTime($unix);
        $this->assertSame(6, $date->getFinancialPeriod());
    }
}
