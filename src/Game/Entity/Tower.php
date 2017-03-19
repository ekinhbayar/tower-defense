<?php declare(strict_types = 1);

namespace Game\Entity;

abstract class Tower implements Buyable
{
    private $id;

    private $unitPrice;

    private $coordinates;

    private $hitPoints;

    private $healthPoints;

    public function __construct(
        int $id,
        Coordinates $coordinates,
        int $unitPrice,
        int $hitPoints,
        int $healthPoints
    )
    {
        $this->id           = $id;
        $this->coordinates  = $coordinates;
        $this->unitPrice    = $unitPrice;
        $this->hitPoints    = $hitPoints;
        $this->healthPoints = $healthPoints;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getCoordinates(): Coordinates
    {
        return $this->coordinates;
    }

    public function getUnitPrice(): int
    {
        return $this->unitPrice;
    }

    public function getHitPoints(): int
    {
        return $this->hitPoints;
    }

    public function getHealthPoints(): int
    {
        return $this->healthPoints;
    }

    public function getTowerAsArray(): array
    {
        return [
            'id'           => $this->id,
            'coordinates'  => $this->coordinates->getAsArray(),
            'unitPrice'    => $this->unitPrice,
            'hitPoints'    => $this->hitPoints,
            'healthPoints' => $this->healthPoints
        ];
    }
}
