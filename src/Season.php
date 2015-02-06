<?php

namespace Regatta\Dates;

/**
 * A representation of a season.
 */
class Season extends Range
{
    const SPRING_SUMMER = "SS";
    const AUTUMN_WINTER = "AW";

    /**
     * @var string $type The type of season is is (one of the class constants SPRING_SUMMER or AUTUMN_WINTER)
     */
    protected $type;

    /**
     * Create a new season from a date object.
     *
     * @param DateTime $date A date within the season
     */
    public function __construct(DateTime $date)
    {
        if ($date->getFinancialPeriod() < 7) {
            $this->type = self::SPRING_SUMMER;
            $start = Date::mkdate($date->getFinancialYear(), 2, 1);
            $end = Date::mkdate($date->getFinancialYear(), 7, 31);
        } else {
            $this->type = self::AUTUMN_WINTER;
            $start = Date::mkdate($date->getFinancialYear(), 8, 1);
            $end = Date::mkdate($date->getFinancialYear() + 1, 1, 31);
        }

        parent::__construct($start, $end);
    }


    /**
     * Get the season code as an integer (eg 140, 145, 150, etc)
     *
     * @return int
     */
    public function getInt()
    {
        $int = $this->start->numeric("y") * 10;
        if ($this->type === self::AUTUMN_WINTER) {
            $int += 5;
        }
        return $int;
    }


    /**
     * Get the season code as string (eg SS14, AW14, etc)
     *
     * @return string
     */
    public function getString()
    {
        return $this->type . $this->start->string("y");
    }


    /**
     * Get the long description of this season (eg Spring/Summer 2014, Autum/Winter 2014, etc)
     *
     * @return string
     */
    public function getDescription()
    {
        if ($this->type === self::SPRING_SUMMER) {
            $desc = "Spring/Summer";
        } else {
            $desc = "Autumn/Winter";
        }

        $desc .= " " . $this->start->string("Y");
        return $desc;
    }
}
