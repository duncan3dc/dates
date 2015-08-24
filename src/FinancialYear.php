<?php

namespace Regatta\Dates;

/**
 * A representation of a financial year (feb-jan).
 */
class FinancialYear extends Range
{
    use Traits\Range;

    /**
     * Create a new instance from a date object.
     *
     * @param DateTime $date A date within the season
     */
    public function __construct(DateTime $date)
    {
        $start = Date::mkdate($date->getFinancialYear(), 2, 1);
        $end = Date::mkdate($date->getFinancialYear() + 1, 1, 31);
        parent::__construct($start, $end);
    }


    /**
     * Create a new instance from a numeric 4 digit year.
     *
     * @param $year The 4 digit year (eg 2015)
     *
     * @return static
     */
    public static function fromInt($year)
    {
        $date = Date::mkdate($year, 2, 1);
        return new static($date);
    }


    /**
     * Get the financial year of this range.
     *
     * @return int
     */
    public function getFinancialYear()
    {
        return $this->start->numeric("Y");
    }
}
