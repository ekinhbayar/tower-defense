<?php declare(strict_types = 1);

namespace Game\Tests\Entity\Player;

use Game\Entity\Coordinates;
use Game\Entity\Player;
use Game\Entity\Player\PlayerFactory;
use Game\Entity\Tower\Base;
use Game\Entity\Tower\Factory;
use PHPUnit\Framework\TestCase;

class PlayerFactoryTest extends TestCase
{
    private $towerFactory;

    private $coordinates;

    public function setUp()
    {
        $this->towerFactory = $this->createMock(Factory::class);
        $this->coordinates  = new Coordinates(100,200);
    }

    public function testBuildReturnsPlayer()
    {
        $this->towerFactory
            ->expects($this->once())
            ->method('build')
            ->with('Base')
            ->will($this->returnValue($this->createMock(Base::class)))
        ;

        $factory = (new PlayerFactory($this->towerFactory))->build('player', $this->coordinates);

        $this->assertInstanceOf(Player::class, $factory);
    }

    public function testBuildIncrementsPlayerId()
    {
        $this->towerFactory
            ->expects($this->any())
            ->method('build')
            ->with('Base')
            ->will($this->returnValue($this->createMock(Base::class)))
        ;

        $factory = new PlayerFactory($this->towerFactory);

        $player0 = $factory->build('player0', $this->coordinates);

        $this->assertEquals(0, $player0->getId());

        $player1 = $factory->build('player1', $this->coordinates);

        $this->assertEquals(1, $player1->getId());
    }
}

