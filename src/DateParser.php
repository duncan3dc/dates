<?php

namespace duncan3dc\Dates;

use duncan3dc\Dates\Interfaces\DateTimeInterface;
use duncan3dc\Dates\Interfaces\ParserInterface;

/**
 * @deprecated Just use DateTimeParser
 */
final class DateParser
{
    private DateTimeParser $parser;


    public function __construct()
    {
        $this->parser = new DateTimeParser();
    }


    public function addParser(ParserInterface $parser): DateTimeParser
    {
        return $this->parser->addParser($parser);
    }


    public function addDefaultParsers(): DateTimeParser
    {
        return $this->parser->addDefaultParsers();
    }


    public function parse(string|int $date, string|int|null $time = null): DateTimeInterface
    {
        return $this->parser->parse($date, $time);
    }
}
