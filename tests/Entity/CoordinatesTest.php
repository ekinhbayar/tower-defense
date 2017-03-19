<?php declare(strict_types = 1);

namespace Game\Tests\Entity;

use Game\Entity\Coordinates;
use PHPUnit\Framework\TestCase;

class CoordinatesTest extends TestCase
{
    private $coordinates;

    public function setUp()
    {
        $this->coordinates = new Coordinates(20, 40);
    }

    public function testGetX()
    {
        $this->assertEquals(20, $this->coordinates->getX());
    }

    public function testGetY()
    {
        $this->assertEquals(40, $this->coordinates->getY());
    }

    public function testGetAsArray()
    {
        $this->assertSame([20, 40], $this->coordinates->getAsArray());
    }
}
