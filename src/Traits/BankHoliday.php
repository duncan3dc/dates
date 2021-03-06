<?php

namespace duncan3dc\Dates\Traits;

use duncan3dc\Dates\Date;

/**
 * Check if this instance is a bank holiday.
 */
trait BankHoliday
{
    /**
     * Check if this object is a bank holiday.
     *
     * @return bool
     */
    public function isBankHoliday()
    {
        return (
               $this->bhNewYearsDay()
            || $this->bhEasterDays()
            || $this->bhMayDays()
            || $this->bhEndOfAugust()
            || $this->bhChristmasDays()
        );
    }

    protected function bhNewYearsDay()
    {
        # If it's not January, or it's after the 3rd then it's not a bh
        if ($this->numeric("m") > 1 || $this->numeric("d") > 3) {
            return false;
        }

        # If it's the 1st or the 1st was a weekend and it's now monday then it's a bh
        if ($this->numeric("d") === 1 || $this->isMonday()) {
            return true;
        }

        return false;
    }

    protected function bhEasterDays()
    {
        $easter = new Date(easter_date($this->numeric("Y")));

        # Check if it's good friday
        if ($this->numeric("Ymd") === $easter->subDays(2)->numeric("Ymd")) {
            return true;
        }

        # Check if it's easter monday
        if ($this->numeric("Ymd") === $easter->addDays(1)->numeric("Ymd")) {
            return true;
        }

        return false;
    }

    protected function bhMayDays()
    {
        # If it's not May then it's not a bh
        if ($this->numeric("m") !== 5) {
            return false;
        }

        # If it's the first monday of the month
        if ($this->numeric("d") <= 7 && $this->isMonday()) {
            return true;
        }

        # If it's the last monday of the month
        if ($this->numeric("d") >= 25 && $this->isMonday()) {
            return true;
        }

        return false;
    }

    protected function bhEndOfAugust()
    {
        # If it's not August then it's not a bh
        if ($this->numeric("m") !== 8) {
            return false;
        }

        # If it's the last monday of the month
        if ($this->numeric("d") >= 25 && $this->isMonday()) {
            return true;
        }

        return false;
    }

    protected function bhChristmasDays()
    {
        # If it's not December then it's not a bh
        if ($this->numeric("m") !== 12) {
            return false;
        }

        # Move the christmas day bh if it's a weekend
        $christmas = Date::mkdate($this->numeric("Y"), 12, 25);
        while ($christmas->isWeekend()) {
            $christmas = $christmas->addDays(1);
        }
        if ($this->string("Ymd") === $christmas->string("Ymd")) {
            return true;
        }

        # Move the boxing day bh if it's a weekend
        $boxing = $christmas->addDays(1);
        while ($boxing->isWeekend()) {
            $boxing = $boxing->addDays(1);
        }
        if ($this->string("Ymd") === $boxing->string("Ymd")) {
            return true;
        }

        return false;
    }
}
