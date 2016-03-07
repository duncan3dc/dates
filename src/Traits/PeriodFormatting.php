<?php

namespace Regatta\Dates\Traits;

use Regatta\Dates\Date;
use Regatta\Dates\Range as RangeInstance;

/**
 * Format the internal unix timestamp in a specified way.
 */
trait PeriodFormatting
{
    use Formatting;

    /**
     * @var Date $period The financial period data for this date
     */
    protected $period = null;


    /**
     * Get the details of the financial period for this date.
     *
     * This method will convert the result to an integer if it looks like one.
     *
     * @var string $format The format to apply to the date, only the characters m, n, y, Y and numbers may be used
     *
     * @return string|int
     */
    public function formatPeriod($format)
    {
        if ($this->period === null) {
            $this->period = new Date(mktime(12, 0, 0, $this->numeric("n") - 1, 1, $this->numeric("Y")));
        }

        if (preg_match("/[^mnyY0-9]/", $format)) {
            throw new \InvalidArgumentException("Invalid period format ({$format}), only 'm', 'n', 'y', 'Y', and numbers may be used");
        }

        return $this->period->format($format);
    }


    /**
     * Get the financial year of this date.
     *
     * @return int
     */
    public function getFinancialYear()
    {
        return (int) $this->formatPeriod("Y");
    }


    /**
     * Get the financial period of this date.
     *
     * @return int
     */
    public function getFinancialPeriod()
    {
        return (int) $this->formatPeriod("n");
    }


    /**
     * Get the financial week of this date.
     *
     * @return int
     */
    public function getFinancialWeek()
    {
        # Get the start date of this financial year
        $year = $this->getFinancialYear();
        $start = Date::mkdate($year, 2, 1);

        $range = new RangeInstance($start, $this);

        $weekNumber = 0;

        # If this year doesn't start on a monday then count the first few days as week 1
        if (!$start->isMonday()) {
            ++$weekNumber;
        }

        # Then for each monday that starts a new week we increase our week number
        foreach ($range->days() as $day) {
            if ($day->isMonday()) {
                ++$weekNumber;
            }
        }

        return $weekNumber;
    }
}
