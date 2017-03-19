<?php declare(strict_types=1);

namespace Game\Tests\Entity\Tower;

use Game\Entity\Coordinates;
use Game\Entity\Tower\Base;
use Game\Entity\Tower\Factory;
use Game\Entity\Tower\UnknownTowerTypeException;
use PHPUnit\Framework\TestCase;

class FactoryTest extends TestCase
{
    private $coordinates;

    public function setUp()
    {
        $this->coordinates = new Coordinates(100,200);
    }

    public function testBuildReturnsTower()
    {
        $this->assertInstanceOf(Base::class, (new Factory())->build("Base", $this->coordinates));
    }

    public function testBuildThrowsOnUnknownTowerType()
    {
        $this->expectException(UnknownTowerTypeException::class);
        (new Factory())->build("UnknownTowerType", $this->coordinates);
    }

    public function testBuildIncrementsTowerId()
    {
        $factory = new Factory();

        $base = $factory->build("Base", $this->coordinates);

        $this->assertEquals(0, $base->getId());

        $laser = $factory->build("Laser", $this->coordinates);

        $this->assertEquals(1, $laser->getId());
    }
}

