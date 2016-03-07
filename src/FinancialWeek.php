<?php

namespace Regatta\Dates;

/**
 * A representation of a financial week.
 */
class FinancialWeek extends Range
{
    use Traits\Range;

    /**
     * Create a new instance from a date object.
     *
     * @param DateTime $date A date within the season
     */
    public function __construct(DateTime $date)
    {
        $week = $date->getFinancialWeek();

        $start = $date;
        while (true) {
            $previousDay = $start->subDays(1);
            if ($previousDay->getFinancialWeek() === $week) {
                $start = $previousDay;
            } else {
                break;
            }
        }

        $end = $date;
        while (true) {
            $nextDay = $end->addDays(1);
            if ($nextDay->getFinancialWeek() === $week) {
                $end = $nextDay;
            } else {
                break;
            }
        }

        parent::__construct($start, $end);
    }


    /**
     * Create a new instance from a financial year and a week number.
     *
     * @param $year The 4 digit year (eg 2015)
     * @param $week The week number (eg 7)
     *
     * @return static
     */
    public static function fromInt($year, $week)
    {
        $week = (int) $week;

        $date = Date::mkdate($year, 2, 1);
        while ($date->getFinancialWeek() !== $week) {
            $date = $date->addDays(1);
        }

        return new static($date);
    }


    /**
     * Get the financial week of this range.
     *
     * @return int
     */
    public function getFinancialWeek()
    {
        return $this->start->getFinancialWeek();
    }
}
