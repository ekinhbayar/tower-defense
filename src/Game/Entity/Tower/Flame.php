<?php declare(strict_types = 1);

namespace Game\Entity\Tower;

use Game\Entity\Coordinates;
use Game\Entity\Tower;

class Flame extends Tower
{
    public function __construct(int $id, Coordinates $coordinates)
    {
        parent::__construct($id, $coordinates, 1000, 75, 2000);
    }
}
