<?php

namespace duncan3dc\DateTests;

use duncan3dc\Dates\Date;

class BankHolidayTest extends \PHPUnit_Framework_TestCase
{
    protected $holidays = [
        2013    =>  [
            [1, 1],
            [3, 29],
            [4, 1],
            [5, 6],
            [5, 27],
            [8, 26],
            [12, 25],
            [12, 26],
        ],
        2014    =>  [
            [1, 1],
            [4, 18],
            [4, 21],
            [5, 5],
            [5, 26],
            [8, 25],
            [12, 25],
            [12, 26],
        ],
        2015    =>  [
            [1, 1],
            [4, 3],
            [4, 6],
            [5, 4],
            [5, 25],
            [8, 31],
            [12, 25],
            [12, 28],
        ],
        2016    =>  [
            [1, 1],
            [3, 25],
            [3, 28],
            [5, 2],
            [5, 30],
            [8, 29],
            [12, 26],
            [12, 27],
        ],
    ];

    public function testBankHolidays()
    {
        foreach ($this->holidays as $year => $dates) {
            foreach ($dates as list($month, $day)) {
                $date = Date::mkdate($year, $month, $day);
                $this->assertTrue($date->isBankHoliday());
            }
        }
    }

    public function testNonBankHolidays()
    {
        foreach ($this->holidays as $year => $dates) {
            foreach ($dates as list($month, $day)) {
                if ($month === 12) {
                    continue;
                }

                $date = Date::mkdate($year, $month, $day);

                $date = $date->subDays(1);
                $this->assertFalse($date->isBankHoliday());

                $date = $date->subDays(1);
                $this->assertFalse($date->isBankHoliday());
            }
        }
    }
}
