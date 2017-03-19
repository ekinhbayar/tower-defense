<?php declare(strict_types = 1);

namespace Game\Entity\Tower;

use Game\Entity\Coordinates;
use Game\Entity\Tower;

class Factory
{
    private $lastTowerId = -1;

    public function build(string $type, Coordinates $coordinates): Tower
    {
        $towerType = __NAMESPACE__ . "\\" . $type;

        if (!$this->isValidType($towerType)) {
            throw new UnknownTowerTypeException($type . " is not a valid tower type.");
        }

        $this->lastTowerId++;

        return new $towerType($this->lastTowerId, $coordinates);
    }

    private function isValidType(string $towerType): bool
    {
        return \class_exists($towerType);
    }
}
