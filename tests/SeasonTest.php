<?php

namespace Regatta\Dates;

class SeasonTest extends \PHPUnit_Framework_TestCase
{

    protected function assertStartTime($expected, $unix)
    {
        $date = new DateTime($unix);
        $season = new Season($date);
        $result = $season->getStart()->timestamp();
        $this->assertSame($expected, $result);
    }
    public function testGetStart1()
    {
        $this->assertStartTime(mktime(12, 0, 0, 2, 1, 2015), mktime(12, 0, 0, 2, 1, 2015));
    }
    public function testGetStart2()
    {
        $this->assertStartTime(mktime(12, 0, 0, 2, 1, 2015), mktime(12, 0, 0, 7, 31, 2015));
    }
    public function testGetStart3()
    {
        $this->assertStartTime(mktime(12, 0, 0, 8, 1, 2015), mktime(12, 0, 0, 8, 1, 2015));
    }
    public function testGetStart4()
    {
        $this->assertStartTime(mktime(12, 0, 0, 8, 1, 2014), mktime(12, 0, 0, 1, 31, 2015));
    }


    protected function assertEndTime($expected, $unix)
    {
        $date = new DateTime($unix);
        $season = new Season($date);
        $result = $season->getEnd()->timestamp();
        $this->assertSame($expected, $result);
    }
    public function testGetEnd1()
    {
        $this->assertEndTime(mktime(12, 0, 0, 7, 31, 2014), mktime(12, 0, 0, 2, 1, 2014));
    }
    public function testGetEnd2()
    {
        $this->assertEndTime(mktime(12, 0, 0, 7, 31, 2014), mktime(12, 0, 0, 7, 31, 2014));
    }
    public function testGetEnd3()
    {
        $this->assertEndTime(mktime(12, 0, 0, 1, 31, 2015), mktime(12, 0, 0, 8, 1, 2014));
    }
    public function testGetEnd4()
    {
        $this->assertEndTime(mktime(12, 0, 0, 1, 31, 2015), mktime(12, 0, 0, 1, 31, 2015));
    }


    protected function assertIntCode($expected, $unix)
    {
        $date = new DateTime($unix);
        $season = new Season($date);
        $result = $season->getInt();
        $this->assertSame($expected, $result);
    }
    public function testGetInt1()
    {
        $this->assertIntCode(140, mktime(12, 0, 0, 2, 1, 2014));
    }
    public function testGetInt2()
    {
        $this->assertIntCode(140, mktime(12, 0, 0, 7, 31, 2014));
    }
    public function testGetInt3()
    {
        $this->assertIntCode(145, mktime(12, 0, 0, 8, 1, 2014));
    }
    public function testGetInt4()
    {
        $this->assertIntCode(145, mktime(12, 0, 0, 1, 31, 2015));
    }


    protected function assertStringCode($expected, $unix)
    {
        $date = new DateTime($unix);
        $season = new Season($date);
        $result = $season->getString();
        $this->assertSame($expected, $result);
    }
    public function testGetString1()
    {
        $this->assertStringCode("SS14", mktime(12, 0, 0, 2, 1, 2014));
    }
    public function testGetString2()
    {
        $this->assertStringCode("SS14", mktime(12, 0, 0, 7, 31, 2014));
    }
    public function testGetString3()
    {
        $this->assertStringCode("AW14", mktime(12, 0, 0, 8, 1, 2014));
    }
    public function testGetString4()
    {
        $this->assertStringCode("AW14", mktime(12, 0, 0, 1, 31, 2015));
    }


    protected function assertDescription($expected, $unix)
    {
        $date = new DateTime($unix);
        $season = new Season($date);
        $result = $season->getDescription();
        $this->assertSame($expected, $result);
    }
    public function testGetDescription1()
    {
        $this->assertDescription("Spring/Summer 2014", mktime(12, 0, 0, 2, 1, 2014));
    }
    public function testGetDescription2()
    {
        $this->assertDescription("Spring/Summer 2014", mktime(12, 0, 0, 7, 31, 2014));
    }
    public function testGetDescription3()
    {
        $this->assertDescription("Autumn/Winter 2014", mktime(12, 0, 0, 8, 1, 2014));
    }
    public function testGetDescription4()
    {
        $this->assertDescription("Autumn/Winter 2014", mktime(12, 0, 0, 1, 31, 2015));
    }


    protected function assertFromInt($code)
    {
        $season = Season::fromInt($code);
        $result = $season->getInt();
        $this->assertSame($code, $result);
    }
    public function testFromInt1()
    {
        $this->assertFromInt(110);
    }
    public function testFromInt2()
    {
        $this->assertFromInt(215);
    }
    public function testFromInt3()
    {
        $this->assertFromInt(115);
    }
    public function testFromInt4()
    {
        $this->assertFromInt(5);
    }


    public function testNow()
    {
        $date = Date::now();
        $check = new Season($date);
        $season = Season::now();
        $this->assertSame($check->getStart()->timestamp(), $season->getStart()->timestamp());
        $this->assertSame($check->getEnd()->timestamp(), $season->getEnd()->timestamp());
    }


    public function testGetType1()
    {
        $season = Season::fromInt(155);
        $this->assertSame(Season::AUTUMN_WINTER, $season->getType());
    }
    public function testGetType2()
    {
        $season = Season::fromInt(150);
        $this->assertSame(Season::SPRING_SUMMER, $season->getType());
    }


    public function testIsSpringSummer1()
    {
        $season = Season::fromInt(140);
        $this->assertTrue($season->isSpringSummer());
    }
    public function testIsSpringSummer2()
    {
        $season = Season::fromInt(145);
        $this->assertFalse($season->isSpringSummer());
    }


    public function testIsAutumnWinter1()
    {
        $season = Season::fromInt(95);
        $this->assertTrue($season->isAutumnWinter());
    }
    public function testIsAutumnWinter2()
    {
        $season = Season::fromInt(90);
        $this->assertFalse($season->isAutumnWinter());
    }
}
