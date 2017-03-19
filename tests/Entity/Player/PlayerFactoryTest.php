<?php declare(strict_types = 1);

namespace Game\Tests\Entity\Player;

use Game\Entity\Coordinates;
use Game\Entity\Player;
use Game\Entity\Player\PlayerFactory;
use PHPUnit\Framework\TestCase;

class PlayerFactoryTest extends TestCase
{
    private $coordinates;

    public function setUp()
    {
        $this->coordinates = new Coordinates(100,200);
    }

    public function testBuildReturnsPlayer()
    {
        $factory = (new PlayerFactory())->build('player', $this->coordinates);
        $this->assertInstanceOf(Player::class, $factory);
    }

    public function testBuildIncrementsPlayerId()
    {
        $factory = new PlayerFactory();

        $player0 = $factory->build('player0', $this->coordinates);

        $this->assertEquals(0, $player0->getId());

        $player1 = $factory->build('player1', $this->coordinates);

        $this->assertEquals(1, $player1->getId());
    }
}

