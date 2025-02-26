<?php

namespace duncan3dc\DateTests;

use duncan3dc\Dates\DateTimeParser;
use PHPUnit\Framework\TestCase;

final class DateTimeParserTest extends TestCase
{
    private DateTimeParser $parser;

    /**
     * @var array<string, string|int>
     */
    private array $dates = [
        "Y-m-d"         =>  "2008-02-22",
        "Y-m-d H:i:s"   =>  "2010-04-30 05:33:21",
        "Y-m-d G:i"     =>  "2015-12-20 7:44",
        "d/m/Y"         =>  "28/02/2008",
        "d/m/y"         =>  "31/01/97",
        "d/m/Y H:i:s"   =>  "28/02/2008 06:30:12",
        "d/m/y H:i:s"   =>  "31/01/97 23:12:00",
        "d/m/Y H:i"     =>  "24/10/1986 14:45",
        "YmdHi"         =>  200905220004,
        "YmdHis"        =>  20060830073359,
        "Ymd"           =>  20080222,
        "Ymd His"       =>  "20100430 021007",
        "Ymd Gis"       =>  "20110101 20003",
        "d-m-Y"         =>  "04-07-2008",
        "d-m-y"         =>  "08-10-13",
        "1ymd"          =>  1070420,
        "1ymd His"      =>  "1101231 042015",
        "1ymd Gis"      =>  "1110615 40004",
        "Y-m-d-H.i.s.u" =>  "2014-02-11-22.54.04.000000",
        "Ym"            =>  201512,
        "U"             =>  1420027200,
    ];


    public function setUp(): void
    {
        $this->parser = new DateTimeParser();
        $this->parser->addDefaultParsers();
    }


    /**
     * @return iterable<array<string|int>>
     */
    public function dateFormatProvider(): iterable
    {
        foreach ($this->dates as $format => $value) {
            yield [$format, $value];
        }
    }
    /**
     * @dataProvider dateFormatProvider
     */
    public function testFormat(string $format, string|int $value): void
    {
        $result = $this->parser->parse($value)->format($format);
        $this->assertSame($value, $result);
    }


    /**
     * @return iterable<array<string>>
     */
    public function datetimeFormatProvider(): iterable
    {
        foreach ($this->dates as $format => $value) {
            if (!strpos($format, " ")) {
                continue;
            }
            $value = (string) $value;
            list($date, $time) = explode(" ", $value);
            yield [$value, $value, $date, $time];
        }
    }
    /**
     * @dataProvider datetimeFormatProvider
     */
    public function testSeparateTime(string $format, string $value, string $date, string $time): void
    {
        $result = $this->parser->parse($date, $time)->format($format);
        $this->assertSame($value, $result);
    }


    public function testNoDate(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage("No date was passed");
        $this->parser->parse(0);
    }


    public function testInvalidFormat(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage("Invalid character found in date (Monday)");
        $this->parser->parse("Monday");
    }


    public function testInvalidTime(): void
    {
        $date = $this->parser->parse("20141201", "7am");
        $this->assertSame(testtime(2014, 12, 1), $date->timestamp());
    }
}
