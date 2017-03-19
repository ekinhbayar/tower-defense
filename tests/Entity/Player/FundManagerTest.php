<?php declare(strict_types = 1);

namespace Game\Tests\Entity\Player;

use Game\Entity\Coordinates;
use Game\Entity\Enemy;
use Game\Entity\Player\PlayerFactory;
use Game\Entity\Tower\Factory;
use Game\Entity\Player\FundManager;
use PHPUnit\Framework\TestCase;

class FundManagerTest extends TestCase
{
    private $tower;

    private $player;

    private $enemy;

    private $fundManager;

    public function setUp()
    {
        $this->fundManager = new FundManager();

        $coordinates = $this->createMock(Coordinates::class);

        $this->player = (new PlayerFactory())->build('player0', $coordinates);

        $this->tower  = (new Factory())->build("Flame", $coordinates);

        $this->enemy  = new Enemy($coordinates, 100, 1000);
    }

    public function testProcessSale()
    {
        $this->fundManager->processSale($this->tower, $this->player);
        $this->assertEquals(9000, $this->player->getFunds());
    }

    public function testProcessEnemyDefeat()
    {
        $this->fundManager->processEnemyDefeat($this->enemy, $this->player);
        $this->assertEquals(10100, $this->player->getFunds());
    }
}
