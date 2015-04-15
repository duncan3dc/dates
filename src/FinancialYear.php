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
}
