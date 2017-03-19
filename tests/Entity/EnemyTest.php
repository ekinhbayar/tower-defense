<?php declare(strict_types = 1);

namespace Game\Tests\Entity;

use Game\Entity\Coordinates;
use Game\Entity\Enemy;
use PHPUnit\Framework\TestCase;

class EnemyTest extends TestCase
{
    private $coordinates;

    private $enemy;

    public function setUp()
    {
        $this->coordinates = new Coordinates(100,200);
        $this->enemy = new Enemy($this->coordinates, 50);
    }

    public function testGetCoordinatesReturnsClass()
    {
        $this->assertInstanceOf(Coordinates::class, $this->enemy->getCoordinates());
    }

    public function testGetCoordinates()
    {
        $this->assertEquals(100, $this->enemy->getCoordinates()->getX());
        $this->assertEquals(200, $this->enemy->getCoordinates()->getY());
    }

    public function testGetHitPoints()
    {
        $this->assertEquals(50, $this->enemy->getHitPoints());
    }

    public function testGetDefaultHealthPoints()
    {
        $this->assertEquals(500, $this->enemy->getHealthPoints());
    }

    public function testGetHealthPoints()
    {
        $enemy = new Enemy($this->coordinates, 50, 300);
        $this->assertEquals(300, $enemy->getHealthPoints());
    }

    public function testIsDead()
    {
        $enemy = new Enemy($this->coordinates, 50, 0);
        $this->assertTrue($enemy->isDead());
    }

    public function testIsNotDead()
    {
        $enemy = new Enemy($this->coordinates, 50, 20);
        $this->assertFalse($enemy->isDead());
    }
}

