<?php declare(strict_types = 1);

namespace Game\Entity;

use Game\Entity\Tower\Base;
use PHPUnit\Framework\TestCase;

class PlayerTest extends TestCase
{
    private $player;

    public function setUp()
    {
        $this->player = new Player(
            1,
            'Player1',
            $this->createMock(Base::class),
            $this->createMock(Towers::class),
            $this->createMock(Coordinates::class),
            100
        );
    }

    public function testGetId()
    {
        $this->assertEquals(1, $this->player->getId());
    }

    public function testGetName()
    {
        $this->assertSame('Player1', $this->player->getName());
    }

    public function testGetBase()
    {
        $this->assertInstanceOf(Base::class, $this->player->getBase());
    }

    public function testGetFunds()
    {
        $this->assertEquals(100, $this->player->getFunds());
    }

    public function testGetTowers()
    {
        $this->assertInstanceOf(Towers::class, $this->player->getTowers());
    }

    public function testGetCoordinates()
    {
        $this->assertInstanceOf(Coordinates::class, $this->player->getCoordinates());
    }

    public function testGetHealthPoints()
    {
        $base = $this->createMock(Base::class);

        $base
            ->expects($this->once())
            ->method('getHealthPoints')
            ->will($this->returnValue(200))
        ;

        $player = new Player(
            1,
            'Player1',
            $base,
            $this->createMock(Towers::class),
            $this->createMock(Coordinates::class),
            100
        );

        $this->assertEquals(200, $player->getHealthPoints());
    }

    public function testSetFunds()
    {
        $this->player->setFunds(30000);

        $this->assertEquals(30000, $this->player->getFunds());
    }
}
