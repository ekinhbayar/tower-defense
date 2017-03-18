<?php declare(strict_types=1);

namespace Game\Entity\Tower;

use Game\Entity\Coordinates;
use Game\Entity\Tower;

class Base extends Tower
{
    public function __construct(int $id, Coordinates $coordinates)
    {
        parent::__construct($id, $coordinates, 0, 50, 4000);
    }
}
