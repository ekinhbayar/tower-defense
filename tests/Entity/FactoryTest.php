<?php

namespace Game\Tests\Entity;

use Game\Entity\Tower\Base;
use Game\Entity\Factory;
use Game\Entity\UnknownTowerTypeException;
use PHPUnit\Framework\TestCase;

class FactoryTest extends TestCase
{
    public function testBuildReturnsTower()
    {
        $this->assertInstanceOf(Base::class, (new Factory())->build("Base"));
    }

    public function testBuildThrowsOnUnknownTowerType()
    {
        $this->expectException(UnknownTowerTypeException::class);
        (new Factory())->build("UnknownTowerType");
    }

    public function testBuildIncrementsTowerId()
    {
        $factory = new Factory();

        $base = $factory->build("Base");

        $this->assertEquals(0, $base->getId());

        $laser = $factory->build("Laser");

        $this->assertEquals(1, $laser->getId());
    }
}

