<?php declare(strict_types = 1);

namespace Game\Entity;

use Game\Entity\Player\PlayerFactory;
use Game\Entity\Tower\Base;
use PHPUnit\Framework\TestCase;

class PlayerTest extends TestCase
{
    private $player;
    private $coordinates;

    public function setUp()
    {
        $this->coordinates = new Coordinates(100,200);
        $this->player      = (new PlayerFactory())->build('player0', $this->coordinates);
    }

    public function testGetId()
    {
        $this->assertEquals(0, $this->player->getId());
    }

    public function testGetName()
    {
        $this->assertSame("player0", $this->player->getName());
    }

    public function testGetBase()
    {
        $this->assertInstanceOf(Base::class, $this->player->getBase());
    }

    public function testGetFunds()
    {
        $this->assertEquals(10000, $this->player->getFunds());
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
        $this->assertEquals(4000, $this->player->getHealthPoints());
    }

    public function testSetFunds()
    {
        $this->player->setFunds(30000);
        $this->assertEquals(30000, $this->player->getFunds());
    }
}
