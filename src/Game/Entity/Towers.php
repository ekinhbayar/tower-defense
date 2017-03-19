<?php declare(strict_types = 1);

namespace Game\Entity;

use Game\Entity\Tower\Factory;

class Towers
{
    private $towerFactory;

    private $towers = [];

    public function __construct(Factory $towerFactory)
    {
        $this->towerFactory = $towerFactory;
    }

    # todo: build() may throw UnknownTowerTypeException, handle it
    public function addTower(string $towerType, Coordinates $coordinates)
    {
        $this->towers[] = $this->towerFactory->build($towerType, $coordinates);
    }

    public function hasTowers(): bool
    {
        return (bool) \count($this->towers);
    }

    public function jsonEncode(): string
    {
        $towers = [];
        foreach ($this->towers as $tower) {
            $towers[] = $tower->getTowerAsArray();
        }
        return \json_encode($towers);
    }
}
