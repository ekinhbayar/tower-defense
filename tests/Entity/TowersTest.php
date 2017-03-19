<?php declare(strict_types = 1);

namespace Game\Tests\Entity;

use Game\Entity\Coordinates;
use Game\Entity\Tower\Factory;
use Game\Entity\Tower\UnknownTowerTypeException;
use Game\Entity\Towers;
use PHPUnit\Framework\TestCase;

class TowersTest extends TestCase
{
    private $towers;

    public function setUp()
    {
        $this->towers = new Towers(new Factory());
    }

    public function testTowersArrayIsEmptyByDefault()
    {
        $this->assertFalse($this->towers->hasTowers());
    }

    public function testAddTowerAddsTower()
    {
        $this->assertFalse($this->towers->hasTowers());

        $this->towers->addTower("Laser", new Coordinates(100,300));

        $this->assertTrue($this->towers->hasTowers());
    }

    public function testAddTowerOnUnknownTowerTypeException()
    {
        try {
            $this->towers->addTower("UnknownTowerType", new Coordinates(100,300));
        } catch (UnknownTowerTypeException $ex) {
            $this->assertEquals($ex->getMessage(), "UnknownTowerType is not a valid tower type.");
            return;
        }
        $this->fail("Expected Exception has not been raised.");
    }

    public function testJsonEncodeWhenThereIsNoTower()
    {
        $this->assertSame('[]', $this->towers->jsonEncode());
    }

    public function testJsonEncodeWhenThereIsTower()
    {
        $expected = '[{"id":0,"coordinates":[100,300],"unitPrice":1000,"hitPoints":75,"healthPoints":2000}]';

        $this->towers->addTower("Flame", new Coordinates(100,300));
        $this->assertSame($expected, $this->towers->jsonEncode());
    }
}
