<?php declare(strict_types=1);

namespace Game\Entity;

class Factory
{
    private $lastTowerId = -1;

    public function build(string $towerType, Coordinates $coordinates): Tower
    {
        $towerType = 'Game\Entity\Tower\\' . $towerType;

        if (!$this->isValidType($towerType)) {
            throw new UnknownTowerTypeException($towerType);
        }

        $this->lastTowerId++;

        return new $towerType($this->lastTowerId, $coordinates);
    }

    private function isValidType(string $towerType): bool
    {
        return \class_exists($towerType);
    }
}
