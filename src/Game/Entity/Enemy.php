<?php declare(strict_types = 1);

namespace Game\Entity;

class Enemy
{
    private $coordinates;

    private $hitPoints;

    private $healthPoints;

    public function __construct(Coordinates $coordinates, int $hitPoints, int $healthPoints = 500)
    {
        $this->coordinates  = $coordinates;
        $this->hitPoints    = $hitPoints;
        $this->healthPoints = $healthPoints;
    }

    public function getCoordinates(): Coordinates
    {
        return $this->coordinates;
    }

    public function getHitPoints(): int
    {
        return $this->hitPoints;
    }

    public function getHealthPoints(): int
    {
        return $this->healthPoints;
    }

    public function isDead(): bool
    {
        return ($this->healthPoints === 0);
    }
}
