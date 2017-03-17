<?php declare(strict_types=1);

namespace Game\Entity;

class Player
{
    private $id;

    private $name;

    private $base;

    private $funds;

    private $towers;

    private $coordinates;

    public function __construct(
        int $id,
        string $name,
        Base $base,
        Towers $towers,
        Coordinates $coordinates,
        int $funds = 5000
    )
    {
        $this->id          = $id;
        $this->name        = $name;
        $this->base        = $base;
        $this->towers      = $towers;
        $this->funds       = $funds;
        $this->coordinates = $coordinates;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getBase(): Base
    {
        return $this->base;
    }

    public function getTowers(): Towers
    {
        return $this->towers;
    }

    public function getFunds(): int
    {
        return $this->funds;
    }

    public function getCoordinates(): Coordinates
    {
        return $this->coordinates;
    }

    public function getHealthPoints(): int
    {
        return $this->base->getHealthPoints();
    }
}
