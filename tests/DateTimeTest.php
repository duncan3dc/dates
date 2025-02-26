<?php

namespace duncan3dc\DateTests;

use duncan3dc\Dates\DateTime;
use duncan3dc\Dates\Interfaces\Days;
use PHPUnit\Framework\TestCase;

final class DateTimeTest extends TestCase
{
    public function testConstructor1(): void
    {
        $unix = time() - 100;
        $date = new DateTime($unix);
        $this->assertSame($unix, $date->timestamp());
    }
    public function testConstructor2(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage("An invalid unix timestamp was passed");
        new DateTime(0);
    }


    public function testNow(): void
    {
        $unix = time();
        $date = DateTime::now();
        $this->assertSame($unix, $date->timestamp());
    }


    public function testStrtotime1(): void
    {
        $expected = DateTime::now()->getNext(Days::TUESDAY);
        $date = DateTime::strtotime("next tuesday");
        $this->assertSame($expected->format("Y-m-d"), $date->format("Y-m-d"));
    }
    public function testStrtotime2(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage("An invalid unix timestamp was passed");
        DateTime::strtotime("nope");
    }


    public function testFormat1(): void
    {
        $unix = time();
        $date = new DateTime($unix);
        $this->assertSame(date("d/m/y", $unix), $date->format("d/m/y"));
    }
    public function testFormat2(): void
    {
        $unix = time();
        $date = new DateTime($unix);
        $this->assertSame((int) date("Ymd", $unix), $date->format("Ymd"));
    }
    public function testFormat3(): void
    {
        $date = DateTime::mktime(11, 22, 33, 1, 18, 2016);
        $this->assertSame(112233, $date->format("His"));
    }
    public function testFormat4(): void
    {
        $date = DateTime::mktime(4, 22, 33, 1, 18, 2016);
        $this->assertSame("042233", $date->format("His"));
    }
    public function testFormat5(): void
    {
        $date = DateTime::mktime(4, 22, 33, 1, 18, 2016);
        $this->assertSame(1, $date->format("n"));
    }
    public function testFormat6(): void
    {
        $date = DateTime::mktime(0, 22, 33, 1, 18, 2016);
        $this->assertSame(0, $date->format("G"));
    }
    public function testNumeric(): void
    {
        $unix = time();
        $date = new DateTime($unix);
        $this->assertSame((int) date("Ymd", $unix), $date->numeric("Ymd"));
    }
    public function testString(): void
    {
        $unix = time();
        $date = new DateTime($unix);
        $this->assertSame(date("Ymd", $unix), $date->string("Ymd"));
    }


    public function testConstructor(): void
    {
        $unix = time();
        $date = DateTime::now();
        $this->assertSame($unix, $date->timestamp());
    }


    public function testMiddayEarly(): void
    {
        $date = new DateTime(testtime(2014, 1, 1, 0));
        $this->assertSame(testtime(2014, 1, 1), $date->midday());
    }
    public function testMiddayLate(): void
    {
        $date = new DateTime(testtime(2014, 1, 1, 23, 59, 59));
        $this->assertSame(testtime(2014, 1, 1), $date->midday());
    }

    public function testStart(): void
    {
        $date = new DateTime(testtime(2014, 1, 1));
        $this->assertSame(testtime(2014, 1, 1, 0), $date->start());
    }
    public function testEnd(): void
    {
        $date = new DateTime(testtime(2014, 1, 1));
        $this->assertSame(testtime(2014, 1, 1, 23, 59, 59), $date->end());
    }


    public function testParse1(): void
    {
        $input = "28/02/2008 06:30:12";
        $result = DateTime::parse($input)->format("d/m/Y H:i:s");
        $this->assertSame($input, $result);
    }
    public function testParse2(): void
    {
        $date = "1101231";
        $time = "042015";
        $result = DateTime::parse($date, $time)->format("1ymd His");
        $this->assertSame("{$date} {$time}", $result);
    }


    /**
     * @return iterable<array<string|int>>
     */
    public function dateFormatProvider(): iterable
    {
        $dates = [
            "28/02/2008 06:30:12"       =>  "d/m/Y H:i:s",
            "March Mon 2 06/30 (2015)"  =>  "F D j H/i (Y)",
            "60504"                     =>  "Gis",
            "20150923 60504"            =>  "Ymd Gis",
        ];
        foreach ($dates as $input => $format) {
            yield [$input, $format];
        }
    }
    /**
     * @dataProvider dateFormatProvider
     */
    public function testFromFormat(string|int $input, string $format): void
    {
        $result = DateTime::fromFormat($format, (string) $input)->format($format);
        $this->assertSame($input, $result);
    }


    public function testFromFormatFail(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage("Invalid date (2015) does not conform to format (y)");
        DateTime::fromFormat("y", "2015");
    }


    public function testMktime(): void
    {
        $date = DateTime::mktime(12, 0, 0, 7, 1, 2014);
        $this->assertSame(testtime(2014, 7, 1), $date->timestamp());
    }


    public function testWithYear(): void
    {
        $date = DateTime::mktime(11, 30, 59, 2, 29, 2016);
        $date = $date->withYear(2017);
        $this->assertSame("2017-02-28 11:30:59", $date->format("Y-m-d H:i:s"));
    }


    public function testWithMonth(): void
    {
        $date = DateTime::mktime(11, 30, 59, 8, 31, 2016);
        $date = $date->withMonth(9);
        $this->assertSame("2016-09-30 11:30:59", $date->format("Y-m-d H:i:s"));
    }


    public function testWithDay(): void
    {
        $date = DateTime::mktime(11, 30, 59, 2, 20, 2016);
        $date = $date->withDay(10);
        $this->assertSame("2016-02-10 11:30:59", $date->format("Y-m-d H:i:s"));
    }
    public function testWithInvalidDay(): void
    {
        $this->expectException(\UnexpectedValueException::class);
        $this->expectExceptionMessage("Unable to set the day to 30 as this month only has 29 days, use withMonth() first");
        $date = DateTime::mktime(11, 30, 59, 2, 20, 2016);
        $date->withDay(30);
    }


    public function testWithHours(): void
    {
        $date = DateTime::mktime(11, 30, 59, 2, 20, 2016);
        $date = $date->withHours(10);
        $this->assertSame("2016-02-20 10:30:59", $date->format("Y-m-d H:i:s"));
    }


    public function testWithMinutes(): void
    {
        $date = DateTime::mktime(11, 30, 59, 2, 20, 2016);
        $date = $date->withMinutes(10);
        $this->assertSame("2016-02-20 11:10:59", $date->format("Y-m-d H:i:s"));
    }


    public function testWithSeconds(): void
    {
        $date = DateTime::mktime(11, 30, 59, 2, 20, 2016);
        $date = $date->withSeconds(10);
        $this->assertSame("2016-02-20 11:30:10", $date->format("Y-m-d H:i:s"));
    }
}
