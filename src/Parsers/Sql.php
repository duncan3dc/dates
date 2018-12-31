<?php

namespace duncan3dc\Dates\Parsers;

use duncan3dc\Dates\Interfaces\ParserInterface;

/**
 * Sql date format (yyyy-mm-dd hh:ii:ss) (with optional milliseconds).
 */
class Sql implements ParserInterface
{
    /**
     * @inheritdoc
     */
    public function parse($date, $time): ?int
    {
        if (preg_match("/^([0-9]{4})-([0-9]{2})-([0-9]{2})[\s-]([0-9]{2})[:\.]([0-9]{2})[:\.]([0-9]{2})(\.[0-9]{6})?$/", $date, $matches)) {
            return mktime((int) $matches[4], (int) $matches[5], (int) $matches[6], (int) $matches[2], (int) $matches[3], (int) $matches[1]);
        }

        return null;
    }
}
