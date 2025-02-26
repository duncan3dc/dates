<?php

namespace duncan3dc\Dates;

use duncan3dc\Dates\DateTime;

/**
 * Parse dates/times in a variety of formats and create a DateTime object.
 */
class DateTimeParser
{
    /**
     * @var array<Parsers\AbstractParser> $parsers The parsers to use for parsing dates/times.
     */
    protected array $parsers = [];

    /**
     * Add a parser to the stack.
     */
    public function addParser(Parsers\AbstractParser $parser): static
    {
        $this->parsers[] = $parser;
        return $this;
    }


    /**
     * Add the default set of parsers the library ships with.
     */
    public function addDefaultParsers(): static
    {
        return $this
            ->addParser(new Parsers\ISO8601())
            ->addParser(new Parsers\Sql())
            ->addParser(new Parsers\HumanReadable())
            ->addParser(new Parsers\SortableDateTime())
            ->addParser(new Parsers\SortableYearMonth())
            ->addParser(new Parsers\IbmDb2())
            ->addParser(new Parsers\Sortable());
    }


    /**
     * Create a new DateTime object from a parsable date/time.
     *
     * @param string|int The date to parse
     * @param string|int|null The time to parse
     */
    public function parse(string|int $date, string|int|null $time = null): DateTime
    {
        if (!$date = trim($date)) {
            throw new \InvalidArgumentException("No date was passed");
        }

        if (preg_match("/[a-z]/i", $date)) {
            throw new \InvalidArgumentException("Invalid character found in date ({$date})");
        }

        if ($time === null && strpos($date, " ")) {
            list($date, $time) = explode(" ", $date);
        }

        foreach ($this->parsers as $parser) {
            $result = $parser->parse($date, $time);
            if ($result !== null) {
                return new DateTime($result);
            }
        }

        if ($unix = (int) date("U", (int) $date)) {
            return new DateTime($unix);
        }

        throw new \InvalidArgumentException("An unparsable date was passed ({$date})");
    }
}
