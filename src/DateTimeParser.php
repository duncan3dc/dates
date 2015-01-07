<?php

namespace duncan3dc\Dates;

use duncan3dc\Dates\DateTime;

/**
 * Parse dates/times in a variety of formats and create a DateTime object.
 */
class DateTimeParser
{
    /**
     * @var Parsers\AbstractParser[] $parsers The parsers to use for parsing dates/times.
     */
    protected $parsers = [];

    /**
     * Create a new instance from a parsable date/time
     *
     * @param string|int The date to parse
     * @param string|int The time to parse
     */
    public static function create($date, $time = null)
    {
        $parser = new static();

        $parser->addParser(new Parsers\ISO8601);
        $parser->addParser(new Parsers\Sql);
        $parser->addParser(new Parsers\HumanReadable);
        $parser->addParser(new Parsers\SortableDateTime);
        $parser->addParser(new Parsers\SortableYearMonth);
        $parser->addParser(new Parsers\IbmDb2);
        $parser->addParser(new Parsers\Sortable);

        return $parser->parse($date, $time);
    }


    /**
     * Add a parser to the stack.
     *
     * @param Parsers\AbstractParser The parser object to add
     *
     * @return static
     */
    public function addParser(Parsers\AbstractParser $parser)
    {
        $this->parsers[] = $parser;
    }


    /**
     * Create a new DateTime object from a parsable date/time
     *
     * @param string|int The date to parse
     * @param string|int The time to parse
     *
     * @return DateTime
     */
    public function parse($date, $time = null)
    {
        if (!$date = trim($date)) {
            throw new \InvalidArgumentException("No date was passed");
        }

        if (preg_match("/[a-z]/i", $date)) {
            throw new \InvalidArgumentException("Invalid character found in date (" . $date . ")");
        }

        foreach ($this->parsers as $parser) {
            $result = $parser->parse($date, $time);
            if ($result !== null) {
                return new DateTime($result);
            }
        }

        if ($unix = (int) date("U", $date)) {
            return new DateTime($unix);
        }

        throw new \InvalidArgumentException("An unparsable date was passed (" . $date . ")");
    }
}
