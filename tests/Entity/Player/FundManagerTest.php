<?php declare(strict_types = 1);

namespace Game\Tests\Entity\Player;

use Game\Entity\Buyable;
use Game\Entity\Enemy;
use Game\Entity\Player;
use Game\Entity\Player\FundManager;
use PHPUnit\Framework\TestCase;

class FundManagerTest extends TestCase
{
    private $fundManager;

    public function setUp()
    {
        $this->fundManager = new FundManager();
    }

    public function testProcessSale()
    {
        $player = $this->createMock(Player::class);

        $player
            ->expects($this->once())
            ->method('getFunds')
            ->will($this->returnValue(1000))
        ;

        $player
            ->expects($this->once())
            ->method('setFunds')
            ->with(900)
        ;

        $buyable = $this->createMock(Buyable::class);

        $buyable
            ->expects($this->once())
            ->method('getUnitPrice')
            ->will($this->returnValue(100))
         ;

        $this->fundManager->processSale($buyable, $player);
    }

    public function testProcessEnemyDefeat()
    {
        $player = $this->createMock(Player::class);

        $player
            ->expects($this->once())
            ->method('getFunds')
            ->will($this->returnValue(1000))
        ;

        $player
            ->expects($this->once())
            ->method('setFunds')
            ->with(1100)
        ;

        $enemy = $this->createMock(Enemy::class);

        $enemy
            ->expects($this->once())
            ->method('getHitPoints')
            ->will($this->returnValue(100))
        ;

        $this->fundManager->processEnemyDefeat($enemy, $player);
    }
}
