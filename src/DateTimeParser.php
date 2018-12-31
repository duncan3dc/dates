<?php

namespace duncan3dc\Dates;

use duncan3dc\Dates\Interfaces\DateTimeInterface;
use duncan3dc\Dates\Interfaces\ParserInterface;

/**
 * Parse dates/times in a variety of formats and create a DateTime object.
 */
final class DateTimeParser
{
    /**
     * @var array<ParserInterface> $parsers The parsers to use for parsing dates/times.
     */
    protected array $parsers = [];

    /**
     * Add a parser to the stack.
     *
     * @return $this
     */
    public function addParser(ParserInterface $parser): self
    {
        $this->parsers[] = $parser;
        return $this;
    }


    /**
     * Add the default set of parsers the library ships with.
     *
     * @return $this
     */
    public function addDefaultParsers(): self
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
     * @param string|int $date The date to parse
     * @param string|int|null $time The time to parse
     */
    public function parse(string|int $date, string|int|null $time = null): DateTimeInterface
    {
        $date = trim((string) $date);
        if (!$date) {
            throw new \InvalidArgumentException("No date was passed");
        }

        if (preg_match("/[a-z]/i", $date)) {
            throw new \InvalidArgumentException("Invalid character found in date ({$date})");
        }

        if ($time === null) {
            if (strpos($date, " ")) {
                list($date, $time) = explode(" ", $date);
            } else {
                $time = "";
            }
        }

        foreach ($this->parsers as $parser) {
            $result = $parser->parse($date, $time);
            if ($result !== null) {
                return new DateTime($result);
            }
        }

        $unix = (int) date("U", (int) $date);

        if ($unix === 0) {
            throw new \InvalidArgumentException("An unparsable date was passed ({$date})");
        }

        return new DateTime($unix);
    }
}
