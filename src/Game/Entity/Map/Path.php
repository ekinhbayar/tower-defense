<?php declare(strict_types = 1);

namespace Game\Entity\Map;

use Game\Entity\Coordinates;

class Path
{
    private $coordinates;

    public function __construct(Coordinates $coordinates)
    {
        $this->coordinates = $coordinates;
    }

    public function getPositionX(): int
    {
        return $this->coordinates->getX();
    }

    public function getPositionY(): int
    {
        return $this->coordinates->getY();
    }

    public function moveUp(): Path
    {
        return new self(new Coordinates($this->getPositionX(), $this->getPositionY() - 20));
    }

    public function moveDown(): Path
    {
        return new self(new Coordinates($this->getPositionX(), $this->getPositionY() + 20));
    }

    public function moveLeft(): Path
    {
        return new self(new Coordinates($this->getPositionX() - 20, $this->getPositionY()));
    }

    public function moveRight(): Path
    {
        return new self(new Coordinates($this->getPositionX() + 20, $this->getPositionY()));
    }
}
