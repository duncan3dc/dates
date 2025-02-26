<?php

namespace duncan3dc\Dates\Parsers;

/**
 * Sql date format (yyyy-mm-dd hh:ii:ss) (with optional milliseconds).
 */
class Sql extends AbstractParser
{
    public function parse(string|int $date, string|int|null $time): ?int
    {
        if (preg_match("/^([0-9]{4})-([0-9]{2})-([0-9]{2})[\s-]([0-9]{2})[:\.]([0-9]{2})[:\.]([0-9]{2})(\.[0-9]{6})?$/", $date, $matches)) {
            return mktime($matches[4], $matches[5], $matches[6], $matches[2], $matches[3], $matches[1]);
        }

        return null;
    }
}
