<?php declare(strict_types=1);

namespace Game\Entity;

abstract class Tower
{
    private $id;

    private $hitPoints;

    private $healthPoints;

    public function __construct(int $id, int $hitPoints, int $healthPoints)
    {
        $this->id           = $id;
        $this->hitPoints    = $hitPoints;
        $this->healthPoints = $healthPoints;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getHitPoints(): int
    {
        return $this->hitPoints;
    }

    public function getHealthPoints(): int
    {
        return $this->healthPoints;
    }
}
