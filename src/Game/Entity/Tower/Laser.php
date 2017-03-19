<?php declare(strict_types = 1);

namespace Game\Entity\Tower;

use Game\Entity\Coordinates;
use Game\Entity\Tower;

class Laser extends Tower
{
    public function __construct(int $id, Coordinates $coordinates)
    {
        parent::__construct($id, $coordinates, 1500, 100, 2000);
    }
}
