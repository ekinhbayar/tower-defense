<?php declare(strict_types = 1);

namespace Game\Entity;

class Coordinates
{
    private $x;

    private $y;

    public function __construct(int $x, int $y)
    {
        $this->x = $x;
        $this->y = $y;
    }

    public function getX()
    {
        return $this->x;
    }

    public function getY()
    {
        return $this->y;
    }

    public function getAsArray()
    {
        return [$this->x, $this->y];
    }
}
